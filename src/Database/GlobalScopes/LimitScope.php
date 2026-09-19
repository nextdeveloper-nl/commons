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

        $maxRowCount = config('commons.query.max_row_count', 5000);
        $rowCount = $model->getPerPage() ?: self::DEFAULT_ROW_COUNT;

        /**
         * `rowCount` on the request overrides the cap, and `all` asks for every row -
         * both are still bounded by $maxRowCount, so a request over HTTP can never pull
         * an unbounded result set into memory. This guards against exactly the failure
         * a plain "all lifts it entirely" would allow: a many-table-join view with
         * json/text payload columns per row, requested with rowCount=all over a wide
         * date range, OOM'd php-fpm because nothing ever capped the result set size.
         * Console/queue code that genuinely wants every row still bypasses this scope
         * entirely with withoutGlobalScope(LimitScope::class).
         */
        if (request()->has('rowCount')) {
            $requested = request()->get('rowCount');

            $rowCount = $requested === 'all' ? $maxRowCount : ((int) $requested ?: $rowCount);
        }

        $builder->limit(min($rowCount, $maxRowCount));
    }
}
