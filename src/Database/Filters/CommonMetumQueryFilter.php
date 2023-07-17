<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
    

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CommonMetumQueryFilter extends AbstractQueryFilter
{
    /**
    * @var Builder
    */
    protected $builder;
    
    public function metableType($value)
    {
        return $this->builder->where('metable_type', 'like', '%' . $value . '%');
    }
    
    public function key($value)
    {
        return $this->builder->where('key', 'like', '%' . $value . '%');
    }
    
    public function value($value)
    {
        return $this->builder->where('value', 'like', '%' . $value . '%');
    }

    public function metableId($value)
    {
        $metable = Metable::where('uuid', $value)->first();

        if($metable) {
            return $this->builder->where('metable_id', '=', $metable->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}