<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;


/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class ValidatablesQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;

    public function objectType($value)
    {
        return $this->builder->where('object_type', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of objectType
    public function object_type($value)
    {
        return $this->objectType($value);
    }

    public function validationCode($value)
    {
        return $this->builder->where('validation_code', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of validationCode
    public function validation_code($value)
    {
        return $this->validationCode($value);
    }

    public function isUsed($value)
    {
        if(!is_bool($value)) {
            $value = false;
        }

        return $this->builder->where('is_used', $value);
    }

        //  This is an alias function of isUsed
    public function is_used($value)
    {
        return $this->isUsed($value);
    }

    public function createdAtStart($date)
    {
        return $this->builder->where('created_at', '>=', $date);
    }

    public function createdAtEnd($date)
    {
        return $this->builder->where('created_at', '<=', $date);
    }

    public function updatedAtStart($date)
    {
        return $this->builder->where('updated_at', '>=', $date);
    }

    public function updatedAtEnd($date)
    {
        return $this->builder->where('updated_at', '<=', $date);
    }

    public function deletedAtStart($date)
    {
        return $this->builder->where('deleted_at', '>=', $date);
    }

    public function deletedAtEnd($date)
    {
        return $this->builder->where('deleted_at', '<=', $date);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
