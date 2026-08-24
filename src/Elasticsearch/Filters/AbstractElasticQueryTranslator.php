<?php

namespace NextDeveloper\Commons\Elasticsearch\Filters;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Helpers\ColumnNameSanitizer;

/**
 * The Elasticsearch-DSL analogue of AbstractQueryFilter: same reflection-driven dispatch
 * (every request query param that matches a method name on the concrete subclass gets
 * that method called), but the subclass methods build an ES bool query via the protected
 * primitives below instead of calling Eloquent where() on a Builder.
 *
 * This is a sibling of AbstractQueryFilter, not a replacement - concrete translators
 * duplicate field logic from their QueryFilter counterpart rather than trying to make one
 * class drive both Eloquent and ES, which would be harder to reason about safely.
 */
abstract class AbstractElasticQueryTranslator
{
    protected Request $request;

    protected array $except = [];

    protected array $overrides = [];

    private array $mustClauses = [];

    private array $sortClauses = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function except()
    {
        $args = func_get_args();
        $size = func_num_args();

        if ($size > 1) {
            $this->except = $args;
        }

        if (1 == count($args)) {
            $this->except = is_array($args[0]) ? $args[0] : $args;
        }
    }

    public function updateValue(string $key, mixed $value): void
    {
        $this->overrides[$key] = $value;
    }

    public function filters(): array
    {
        return array_merge(
            $this->request->except($this->except),
            $this->overrides
        );
    }

    /**
     * Runs every applicable filter method and returns the resulting ES query body
     * (query + sort), ready to merge with an authorization filter and pagination.
     */
    public function translate(): array
    {
        $this->mustClauses = [];
        $this->sortClauses = [];

        foreach ($this->filters() as $name => $value) {
            $value = $this->transformFilterValue($name, $value);

            if (method_exists($this, $name) && $this->checkFilterRules($name)) {
                $r = new \ReflectionMethod($this, $name);
                $s = count($r->getParameters());

                if (0 == $s || ($s > 0 && !is_null($value))) {
                    call_user_func_array([$this, $name], array_filter([$value], function ($v) {
                        return isset($v);
                    }));
                }
            }
        }

        return [
            'query' => empty($this->mustClauses)
                ? ['match_all' => new \stdClass()]
                : ['bool' => ['must' => $this->mustClauses]],
            'sort' => $this->sortClauses,
        ];
    }

    protected function transformFilterValue(string $name, mixed $value): mixed
    {
        return $value; // Default: no transformation
    }

    /**
     * Comma-separated col|direction pairs, same syntax as AbstractQueryFilter::order().
     */
    public function order($value): void
    {
        foreach (explode(',', $value) as $item) {
            if (str_contains($item, '|')) {
                [$column, $direction] = explode('|', $item);
            } else {
                $column = $item;
                $direction = 'asc';
            }

            $this->sortClauses[] = [ColumnNameSanitizer::sanitize($column) => strtolower($direction)];
        }
    }

    /**
     * Alias of order(), matching AbstractQueryFilter::sort().
     */
    public function sort($value): void
    {
        $this->order($value);
    }

    /**
     * ≈ ilike '%value%' - substring/full-text match on a text field.
     */
    protected function matchPhrase(string $field, $value): void
    {
        $this->addClause(['match_phrase' => [$field => $value]]);
    }

    /**
     * ≈ exact eq/bool.
     */
    protected function term(string $field, $value): void
    {
        $this->addClause(['term' => [$field => $value]]);
    }

    /**
     * ≈ tags @> ARRAY[...] containment - a terms filter against a keyword array field.
     */
    protected function terms(string $field, array $values): void
    {
        $this->addClause(['terms' => [$field => $values]]);
    }

    /**
     * ≈ cpu/ram comparator parsing and the created_at_start/end style date-range pairs.
     * $op is one of gt/gte/lt/lte.
     */
    protected function range(string $field, string $op, $value): void
    {
        $this->addClause(['range' => [$field => [$op => $value]]]);
    }

    /**
     * Escape hatch for a raw ES query clause that doesn't fit the primitives above.
     */
    protected function addClause(array $clause): void
    {
        $this->mustClauses[] = $clause;
    }

    private function checkFilterRules(string $filterName): bool
    {
        $results = [];

        if (method_exists($this, 'filterRules')) {
            $rules = $this->filterRules();

            if (isset($rules[$filterName])) {
                if (!is_array($rules[$filterName])) {
                    $rules[$filterName] = (array) $rules[$filterName];
                }

                foreach ($rules[$filterName] as $filter) {
                    if (is_callable($filter)) {
                        $results[] = $filter();
                    } else {
                        if (str_contains($filter, ':')) {
                            [$func, $args] = explode(':', $filter);

                            $results[] = call_user_func_array([$this, $func], explode(',', $args));
                        } else {
                            $results[] = call_user_func([$this, $filter]);
                        }
                    }
                }
            }
        }

        return !collect($results)->contains(false);
    }
}
