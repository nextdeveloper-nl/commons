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
                    return '{' . implode(',', $value) . '}';
                } catch (\Exception $e) {
                    throw new DataTypeException('The given value is not a json or an array. ' .
                        'Please provide an array to this file type: ' . $key);
                }
            }

            throw new DataTypeException('The given value is not an array. ' .
                'Please provide an array to this file type: ' . $key);
        }

        return '{' . implode(',', $value) . '}';
    }
}
