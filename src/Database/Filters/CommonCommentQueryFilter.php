<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
use NextDeveloper\Accounts\Database\Models\User;
            

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CommonCommentQueryFilter extends AbstractQueryFilter
{
    /**
    * @var Builder
    */
    protected $builder;
    
    public function body($value)
    {
        return $this->builder->where('body', 'like', '%' . $value . '%');
    }
    
    public function commentableType($value)
    {
        return $this->builder->where('commentable_type', 'like', '%' . $value . '%');
    }

    public function lft($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
           $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('_lft', $operator, $value);
    }
    
    public function rgt($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
           $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('_rgt', $operator, $value);
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

    public function iamUserId($value)
    {
        $iamUser = IamUser::where('uuid', $value)->first();

        if($iamUser) {
            return $this->builder->where('iam_user_id', '=', $iamUser->id);
        }
    }

    public function commentableId($value)
    {
        $commentable = Commentable::where('uuid', $value)->first();

        if($commentable) {
            return $this->builder->where('commentable_id', '=', $commentable->id);
        }
    }

    public function parentId($value)
    {
        $parent = Parent::where('uuid', $value)->first();

        if($parent) {
            return $this->builder->where('parent_id', '=', $parent->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}