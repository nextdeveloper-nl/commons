<?php
/**
 * This file is part of the PlusClouds.Core library.
 *
 * (c) Semih Turna <semih.turna@plusclouds.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use NextDeveloper\Commons\Helpers\ColumnNameSanitizer;

/**
 * Class AbstractQueryFilter.
 *
 * @package PlusClouds\Core\Database\Filters
 */
abstract class AbstractQueryFilter {
    use Macroable;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $except = [];

    /**
     * @var array
     */
    protected $overrides = [];

    /**
     * QueryFilter constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * @return void
     */
    public function except() {
        $args = func_get_args();
        $size = func_num_args();

        if ($size > 1) {
            $this->except = $args;
        }

        if (1 == count($args)) {
            $this->except = is_array($args[0]) ? $args[0] : $args;
        }
    }

    /**
     * @param Builder $builder
     *
     * @throws \ReflectionException
     *
     * @return Builder
     */
    public function apply(Builder $builder) {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            // Transform the value before passing it to the filter method
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

        return $this->builder;
    }

    protected function transformFilterValue(string $name, mixed $value): mixed {
        return $value; // Default: no transformation
    }

    public function updateValue(string $key, mixed $value): void {
        $this->overrides[$key] = $value;
    }

    /**
     * @return array
     */
    public function filters() {
        return array_merge(
            $this->request->except($this->except),
            $this->overrides
        );
    }

    /**
     * @param string $value
     *
     * @return Builder
     */
    public function order($value) {
        $value = explode(',', $value);

        foreach ($value as $item) {
            if (str_contains($item, '|')) {
                [$column, $direction] = explode('|', $item);
            } else {
                $column = $item;
                $direction = 'ASC';
            }

            $this->builder->orderBy(ColumnNameSanitizer::sanitize($column), $direction);
        }

        return $this->builder;
    }

    /**
     * Alias of order function
     *
     * @param $value
     * @return Builder
     */
    public function sort($value) {
        return self::order($value);
    }

    /**
     * @param string $filterName
     *
     * @return bool
     */
    private function checkFilterRules($filterName) {
        $results = [];

        if (method_exists($this, 'filterRules')) {
            $rules = $this->filterRules();

            if (isset($rules[$filterName])) {
                if ( ! is_array($rules[$filterName])) {
                    $rules[$filterName] = (array)$rules[$filterName];
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

        return ! collect($results)->contains(false);
    }
}
