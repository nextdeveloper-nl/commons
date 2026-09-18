<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Helpers\ObjectHelper;

/**
 * Where clauses for query filters.
 *
 * Static on purpose: AbstractQueryFilter calls any method of the filter whose name matches a query
 * string key, so a helper method on the filter itself would be reachable from the URL.
 */
final class FilterClauses
{
    /**
     * A foreign key column matching one of the comma separated uuids.
     *
     * A value that resolves to nothing matches nothing. It used to be skipped, which answered
     * every row as if the filter had not been sent.
     *
     * @param class-string<Model> $model
     */
    public static function linkedId(Builder $builder, string $column, string $model, $value): Builder
    {
        $ids = self::ids($model, $value);

        if ($ids === null) {
            return $builder->whereRaw('false');
        }

        return $builder->whereIn($builder->getModel()->qualifyColumn($column), $ids);
    }

    /**
     * A bigint[] link list containing at least one of the comma separated uuids.
     *
     * @param class-string<Model> $model
     */
    public static function linksAny(Builder $builder, string $column, string $model, $value): Builder
    {
        $ids = self::ids($model, $value);

        if ($ids === null) {
            return $builder->whereRaw('false');
        }

        return $builder->whereRaw(
            $builder->getModel()->qualifyColumn($column) . ' && ?::bigint[]',
            ['{' . implode(',', array_map('intval', $ids)) . '}']
        );
    }

    /**
     * Rows carrying every one of the comma separated tags. The tags are bound, never concatenated
     * into the SQL.
     */
    public static function tags(Builder $builder, $values): Builder
    {
        $tags = array_values(array_filter(
            array_map('trim', explode(',', (string) $values)),
            fn ($tag) => $tag !== ''
        ));

        if (!$tags) {
            return $builder;
        }

        return $builder->whereRaw(
            $builder->getModel()->qualifyColumn('tags') . ' @> ARRAY[' . implode(',', array_fill(0, count($tags), '?')) . ']::text[]',
            $tags
        );
    }

    /**
     * object_type naming a model, given as the class or in its public form. A value with no
     * namespace keeps the substring match; a class name has to match exactly, because the
     * backslashes in it are escape characters to ILIKE and never matched anything.
     */
    public static function objectType(Builder $builder, $value): Builder
    {
        $column = $builder->getModel()->qualifyColumn('object_type');
        $value = (string) $value;

        if (!str_contains($value, '\\')) {
            return $builder->where($column, 'ilike', '%' . addcslashes($value, '%_\\') . '%');
        }

        //  A type this helper does not know (an application's own model) still matches as written.
        return $builder->where($column, ObjectHelper::getModelClass($value) ?? ltrim($value, '\\'));
    }

    /**
     * Rows referencing one of the comma separated uuids of $objectType (class or public form).
     * Without a known type nothing matches: an id means nothing on its own.
     */
    public static function objectId(Builder $builder, $objectType, $value): Builder
    {
        $class = ObjectHelper::getModelClass(is_string($objectType) ? $objectType : null);

        $ids = $class ? self::ids($class, $value) : null;

        if ($ids === null) {
            return $builder->whereRaw('false');
        }

        return $builder->where($builder->getModel()->qualifyColumn('object_type'), $class)
            ->whereIn($builder->getModel()->qualifyColumn('object_id'), $ids);
    }

    /**
     * The ids of the uuids in a filter value (comma separated), or null when none resolves.
     *
     * Resolved without the caller's role scope: the rows being filtered are scoped already, and a
     * related record the caller cannot open is still a valid thing to filter by. Soft deleted rows
     * count too - filtering by a deleted parent still finds its children.
     *
     * @param class-string<Model> $model
     * @return array<int>|null
     */
    public static function ids(string $model, $value): ?array
    {
        $uuids = array_values(array_filter(
            array_map('trim', explode(',', (string) $value)),
            fn ($uuid) => Str::isUuid($uuid)
        ));

        if (!$uuids) {
            return null;
        }

        $ids = $model::withoutGlobalScopes()->whereIn('uuid', $uuids)->pluck('id')->all();

        return $ids ?: null;
    }
}
