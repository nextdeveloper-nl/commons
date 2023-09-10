<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
    

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class StatesQueryFilter extends AbstractQueryFilter
{
    /**
    * @var Builder
    */
    protected $builder;
    
    public function name($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }
    
    public function value($value)
    {
        return $this->builder->where('value', 'like', '%' . $value . '%');
    }
    
    public function reason($value)
    {
        return $this->builder->where('reason', 'like', '%' . $value . '%');
    }
    
    public function modelType($value)
    {
        return $this->builder->where('model_type', 'like', '%' . $value . '%');
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

    public function deletedAtStart($date) 
    {
        return $this->builder->where( 'deleted_at', '>=', $date );
    }

    public function deletedAtEnd($date) 
    {
        return $this->builder->where( 'deleted_at', '<=', $date );
    }

    public function modelId($value)
    {
        $model = Model::where('uuid', $value)->first();

        if($model) {
            return $this->builder->where('model_id', '=', $model->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n
}