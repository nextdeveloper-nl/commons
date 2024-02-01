<?php

namespace NextDeveloper\Commons\Database\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

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

        return '{' . implode(',', $value) . '}';
    }
}
