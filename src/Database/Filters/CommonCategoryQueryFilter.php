<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
        

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CommonCategoryQueryFilter extends AbstractQueryFilter
{
    /**
    * @var Builder
    */
    protected $builder;
    
    public function slug($value)
    {
        return $this->builder->where('slug', 'like', '%' . $value . '%');
    }
    
    public function name($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }
    
    public function description($value)
    {
        return $this->builder->where('description', 'like', '%' . $value . '%');
    }
    
    public function url($value)
    {
        return $this->builder->where('url', 'like', '%' . $value . '%');
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
    
    public function order($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
           $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('order', $operator, $value);
    }
    
    public function isActive()
    {
        return $this->builder->where('is_active', true);
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

    public function commonDomainId($value)
    {
        $commonDomain = CommonDomain::where('uuid', $value)->first();

        if($commonDomain) {
            return $this->builder->where('common_domain_id', '=', $commonDomain->id);
        }
    }

    public function commonCategoriesParentId($value)
    {
        $commonCategoriesParent = CommonCategoriesParent::where('uuid', $value)->first();

        if($commonCategoriesParent) {
            return $this->builder->where('common_categories_parent_id', '=', $commonCategoriesParent->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}