<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
                use NextDeveloper\Accounts\Database\Models\User;
    

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class RemindableQueryFilter extends AbstractQueryFilter
{
    /**
    * @var Builder
    */
    protected $builder;
    
    public function remindableObjectType($value)
    {
        return $this->builder->where('remindable_object_type', 'like', '%' . $value . '%');
    }
    
    public function note($value)
    {
        return $this->builder->where('note', 'like', '%' . $value . '%');
    }

    public function remindDatetimeStart($date) 
    {
        return $this->builder->where( 'remind_datetime', '>=', $date );
    }

    public function remindDatetimeEnd($date) 
    {
        return $this->builder->where( 'remind_datetime', '<=', $date );
    }

    public function snoozeDatetimeStart($date) 
    {
        return $this->builder->where( 'snooze_datetime', '>=', $date );
    }

    public function snoozeDatetimeEnd($date) 
    {
        return $this->builder->where( 'snooze_datetime', '<=', $date );
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

    public function remindableId($value)
    {
        $remindable = Remindable::where('uuid', $value)->first();

        if($remindable) {
            return $this->builder->where('remindable_id', '=', $remindable->id);
        }
    }

    public function userId($value)
    {
        $user = User::where('uuid', $value)->first();

        if($user) {
            return $this->builder->where('user_id', '=', $user->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}