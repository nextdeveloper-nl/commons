<?php

namespace NextDeveloper\Commons\Database\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
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

        $value = str_replace(['{', '}'], '', $value);
        return explode(',', $value);
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

        // If the given value string is not an array, convert it to an array.
        if(is_string($value)) {
            $value = explode(',', $value);
        }

        if(!is_array($value)) {
            throw new DataTypeException('The given value is not an array. ' .
                'Please provide an array to this file type: ' . $key);
        }

        return '{' . implode(',', $value) . '}';
    }
}
