<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
    

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class DomainablesQueryFilter extends AbstractQueryFilter
{
    /**
    * @var Builder
    */
    protected $builder;
    
    public function domainableType($value)
    {
        return $this->builder->where('domainable_type', 'like', '%' . $value . '%');
    }

    public function createdAtStart($date) 
    {
        return $this->builder->where( 'created_at', '>=', $date );
    }

    public function createdAtEnd($date) 
    {
        return $this->builder->where( 'created_at', '<=', $date );
    }

    public function updatedAtStart($date) 
    {
        return $this->builder->where( 'updated_at', '>=', $date );
    }

    public function updatedAtEnd($date) 
    {
        return $this->builder->where( 'updated_at', '<=', $date );
    }

    public function domainableId($value)
    {
        $domainable = Domainable::where('uuid', $value)->first();

        if($domainable) {
            return $this->builder->where('domainable_id', '=', $domainable->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n
}