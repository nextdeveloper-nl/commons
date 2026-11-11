<?php

namespace NextDeveloper\Commons\Database\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Exceptions\DataTypeException;

class TextArray implements CastsAttributes
{
    /**
     * Transform the attribute from the underlying model values.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param ?string $value
     *
     * @return ?array<text, mixed>
     */
    public function get($model, string $key, mixed $value, array $attributes): ?array
    {
        if (null === $value) {
            return null;
        }

        if (is_array($value)) {
            return $value;
        }

        return self::parse($value);
    }

    /**
     * Parse a one-dimensional PostgreSQL array literal ({a,"b, c","d \"e\""}).
     *
     * Quoted elements may contain commas, braces and backslash-escaped quotes,
     * so the literal can't simply be split on commas: an element such as
     * "Cloud Services (Modernization, Architecture, Migration)" must come back
     * as one value, not three fragments.
     *
     * @return array<int, ?string>
     */
    public static function parse(string $literal): array
    {
        $literal = trim($literal);

        if (str_starts_with($literal, '{') && str_ends_with($literal, '}')) {
            $literal = substr($literal, 1, -1);
        }

        if (trim($literal) === '') {
            return [];
        }

        $values = [];
        $length = strlen($literal);
        $i = 0;

        while ($i <= $length) {
            while ($i < $length && ctype_space($literal[$i])) {
                $i++;
            }

            if ($i < $length && $literal[$i] === '"') {
                $element = '';
                $i++;

                while ($i < $length && $literal[$i] !== '"') {
                    if ($literal[$i] === '\\' && $i + 1 < $length) {
                        $i++;
                    }
                    $element .= $literal[$i];
                    $i++;
                }

                // Skip the closing quote and anything up to the separator.
                $i++;
                while ($i < $length && $literal[$i] !== ',') {
                    $i++;
                }

                $values[] = $element;
            } else {
                $end = strpos($literal, ',', $i);
                $end = $end === false ? $length : $end;
                $element = trim(substr($literal, $i, $end - $i));

                // An unquoted NULL is SQL NULL; a quoted "NULL" is the string.
                $values[] = strcasecmp($element, 'NULL') === 0 ? null : $element;
                $i = $end;
            }

            // $i is now on a separator (or past the end).
            $i++;
        }

        return $values;
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array<text, mixed>|\Illuminate\Support\Collection<int, mixed>|null $value
     */
    public function set($model, string $key, mixed $value, array $attributes): ?string
    {
        if (null === $value) {
            return null;
        }

        //  This means that we received a json string instead of an array.
        if(!is_array($value)) {
            Log::info('We get this $value to convert as not array: ' . $value);

            if(Str::contains($value, ['{', '}'])) {
                //  We will try converting to array from json.
                try {
                    $value = json_decode($value, true);

                    //  @todo:
                    //  This is very interesting. I dont know why it happens but if we use try catch here,
                    //  $value variable is not updated. So I put this return here as workaround. But this should be
                    //  fixed
                    return '{' . implode(',', array_map([$this, 'escapeElement'], array_map('strval', $value))) . '}';
                } catch (\Exception $e) {
                    throw new DataTypeException('The given value is not a json or an array. ' .
                        'Please provide an array to this file type: ' . $key);
                }
            }

            throw new DataTypeException('The given value is not an array. ' .
                'Please provide an array to this file type: ' . $key);
        }

        return '{' . implode(',', array_map([$this, 'escapeElement'], array_map('strval', $value))) . '}';
    }

    /**
     * Escape a single array element for use in a PostgreSQL array literal.
     *
     * Elements containing double quotes, commas, whitespace, backslashes, or
     * braces must be double-quoted. Double quotes and backslashes inside the
     * element are escaped with a backslash.
     */
    private function escapeElement(string $value): string
    {
        if ($value === '' || $value === 'NULL' || preg_match('/[",\s{}\\\\]/', $value)) {
            $escaped = str_replace('\\', '\\\\', $value);
            $escaped = str_replace('"', '\\"', $escaped);
            return '"' . $escaped . '"';
        }

        return $value;
    }
}
