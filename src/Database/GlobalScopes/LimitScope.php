<?php

namespace NextDeveloper\Commons\Database\GlobalScopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Caps how many rows an unbounded query may return.
 *
 * The cap exists so that a plain `Model::get()` against a large table cannot load it
 * all into memory. It is a safety net for queries that asked for no limit at all, and
 * it must not override a caller that did ask for one.
 */
class LimitScope implements Scope
{
    /**
     * The default cap for a query that specifies no limit of its own.
     */
    private const DEFAULT_ROW_COUNT = 20;

    public function apply(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();

        //  Global scopes are applied when the query runs, which is after paginate(),
        //  take() and limit() have set theirs. Overwriting it here truncated the page:
        //  paginate(100) counted 100 for the envelope and then returned 20 rows, so a
        //  client was told there was a single page and silently handed a fifth of it.
        $property = $query->unions ? 'unionLimit' : 'limit';

        if ($query->{$property} !== null) {
            return;
        }

        $rowCount = $model->getPerPage() ?: self::DEFAULT_ROW_COUNT;

        /**
         * `rowCount` on the request overrides the cap, and `all` lifts it entirely.
         * It is read from the request rather than passed in, so it only reaches this
         * scope over HTTP; console and queue code that wants every row asks for it
         * with `withoutGlobalScope(LimitScope::class)`.
         */
        if (request()->has('rowCount')) {
            $requested = request()->get('rowCount');

            if ($requested === 'all') {
                return;
            }

            $rowCount = (int) $requested ?: $rowCount;
        }

        $builder->limit($rowCount);
    }
}
