<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
    

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class TaskSchedulersQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;
    
    public function name($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }
    
    public function description($value)
    {
        return $this->builder->where('description', 'like', '%' . $value . '%');
    }
    
    public function objectName($value)
    {
        return $this->builder->where('object_name', 'like', '%' . $value . '%');
    }
    
    public function output($value)
    {
        return $this->builder->where('output', 'like', '%' . $value . '%');
    }

    public function nextRunStart($date)
    {
        return $this->builder->where('next_run', '>=', $date);
    }

    public function nextRunEnd($date)
    {
        return $this->builder->where('next_run', '<=', $date);
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

    public function lastRunStart($date)
    {
        return $this->builder->where('last_run', '>=', $date);
    }

    public function lastRunEnd($date)
    {
        return $this->builder->where('last_run', '<=', $date);
    }

    public function commonAvailableActionId($value)
    {
            $commonAvailableAction = \NextDeveloper\Commons\Database\Models\AvailableActions::where('uuid', $value)->first();

        if($commonAvailableAction) {
            return $this->builder->where('common_available_action_id', '=', $commonAvailableAction->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
