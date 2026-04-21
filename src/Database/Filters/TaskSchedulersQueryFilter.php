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
        return $this->builder->where('name', 'ilike', '%' . $value . '%');
    }

        
    public function description($value)
    {
        return $this->builder->where('description', 'ilike', '%' . $value . '%');
    }

        
    public function scheduleType($value)
    {
        return $this->builder->where('schedule_type', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of scheduleType
    public function schedule_type($value)
    {
        return $this->scheduleType($value);
    }
        
    public function objectType($value)
    {
        return $this->builder->where('object_type', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of objectType
    public function object_type($value)
    {
        return $this->objectType($value);
    }
        
    public function cronExpression($value)
    {
        return $this->builder->where('cron_expression', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of cronExpression
    public function cron_expression($value)
    {
        return $this->cronExpression($value);
    }
        
    public function timezone($value)
    {
        return $this->builder->where('timezone', 'ilike', '%' . $value . '%');
    }

    
    public function dayOfMonth($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
            $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('day_of_month', $operator, $value);
    }

        //  This is an alias function of dayOfMonth
    public function day_of_month($value)
    {
        return $this->dayOfMonth($value);
    }
    
    public function dayOfWeek($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
            $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('day_of_week', $operator, $value);
    }

        //  This is an alias function of dayOfWeek
    public function day_of_week($value)
    {
        return $this->dayOfWeek($value);
    }
    
    public function nextRunAtStart($date)
    {
        return $this->builder->where('next_run_at', '>=', $date);
    }

    public function nextRunAtEnd($date)
    {
        return $this->builder->where('next_run_at', '<=', $date);
    }

    //  This is an alias function of nextRunAt
    public function next_run_at_start($value)
    {
        return $this->nextRunAtStart($value);
    }

    //  This is an alias function of nextRunAt
    public function next_run_at_end($value)
    {
        return $this->nextRunAtEnd($value);
    }

    public function createdAtStart($date)
    {
        return $this->builder->where('created_at', '>=', $date);
    }

    public function createdAtEnd($date)
    {
        return $this->builder->where('created_at', '<=', $date);
    }

    //  This is an alias function of createdAt
    public function created_at_start($value)
    {
        return $this->createdAtStart($value);
    }

    //  This is an alias function of createdAt
    public function created_at_end($value)
    {
        return $this->createdAtEnd($value);
    }

    public function updatedAtStart($date)
    {
        return $this->builder->where('updated_at', '>=', $date);
    }

    public function updatedAtEnd($date)
    {
        return $this->builder->where('updated_at', '<=', $date);
    }

    //  This is an alias function of updatedAt
    public function updated_at_start($value)
    {
        return $this->updatedAtStart($value);
    }

    //  This is an alias function of updatedAt
    public function updated_at_end($value)
    {
        return $this->updatedAtEnd($value);
    }

    public function deletedAtStart($date)
    {
        return $this->builder->where('deleted_at', '>=', $date);
    }

    public function deletedAtEnd($date)
    {
        return $this->builder->where('deleted_at', '<=', $date);
    }

    //  This is an alias function of deletedAt
    public function deleted_at_start($value)
    {
        return $this->deletedAtStart($value);
    }

    //  This is an alias function of deletedAt
    public function deleted_at_end($value)
    {
        return $this->deletedAtEnd($value);
    }

    public function commonAvailableActionId($value)
    {
            $commonAvailableAction = \NextDeveloper\Commons\Database\Models\AvailableActions::where('uuid', $value)->first();

        if($commonAvailableAction) {
            return $this->builder->where('common_available_action_id', '=', $commonAvailableAction->id);
        }
    }

        //  This is an alias function of commonAvailableAction
    public function common_available_action_id($value)
    {
        return $this->commonAvailableAction($value);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE





}
