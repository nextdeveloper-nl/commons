<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;


/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class LanguagesQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;

    public function name($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }

    public function nativeName($value)
    {
        return $this->builder->where('native_name', 'like', '%' . $value . '%');
    }

    public function isDefault($value)
    {


        return $this->builder->where('is_default', $value);
    }

    public function isActive($value)
    {
        return $this->builder->where('is_active', $value);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE










}
