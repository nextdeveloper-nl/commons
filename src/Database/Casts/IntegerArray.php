<?php

namespace NextDeveloper\Commons\Database\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class IntegerArray implements CastsAttributes
{
    /**
     * Transform the attribute from the underlying model value.
     * Converts PostgreSQL array literal {1,2,3} to a PHP integer array.
     */
    public function get($model, string $key, mixed $value, array $attributes): ?array
    {
        if (null === $value) {
            return null;
        }

        $value = str_replace(['{', '}'], '', $value);

        //  An empty PostgreSQL array literal is {}, which explodes into [''] and would
        //  otherwise be read back as [0].
        if ($value === '') {
            return [];
        }

        return array_map('intval', explode(',', $value));
    }

    /**
     * Transform the attribute to its underlying model value.
     * Converts a PHP integer array to PostgreSQL array literal {1,2,3}.
     */
    public function set($model, string $key, mixed $value, array $attributes): ?string
    {
        if (null === $value) {
            return null;
        }

        return '{' . implode(',', array_map('intval', (array) $value)) . '}';
    }
}
