<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
use NextDeveloper\Commons\Database\Filters\FilterClauses;
        

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CategoriesQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;

    public function slug($value)
    {
        return $this->builder->where('slug', 'ilike', '%' . $value . '%');
    }


    public function name($value)
    {
        return $this->builder->where('name', 'ilike', '%' . $value . '%');
    }


    public function description($value)
    {
        return $this->builder->where('description', 'ilike', '%' . $value . '%');
    }


    public function url($value)
    {
        return $this->builder->where('url', 'ilike', '%' . $value . '%');
    }


    public function objectType($value)
    {
        return FilterClauses::objectType($this->builder, $value);
    }

    /**
     * Rows of one or more records (comma separated uuids of the object_type sent along).
     */
    public function objectId($value)
    {
        return FilterClauses::objectId(
            $this->builder,
            $this->request->get('object_type', $this->request->get('objectType')),
            $value
        );
    }

    //  This is an alias function of objectId
    public function object_id($value)
    {
        return $this->objectId($value);
    }

        //  This is an alias function of objectType
    public function object_type($value)
    {
        return $this->objectType($value);
    }

    public function position($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
            $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('position', $operator, $value);
    }


    public function isActive($value)
    {
        return $this->builder->where('is_active', $value);
    }

        //  This is an alias function of isActive
    public function is_active($value)
    {
        return $this->isActive($value);
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

    public function commonDomainId($value)
    {
        return FilterClauses::linkedId($this->builder, 'common_domain_id', \NextDeveloper\Commons\Database\Models\Domains::class, $value);
    }

        //  This is an alias function of commonDomain
    public function common_domain_id($value)
    {
        return $this->commonDomainId($value);
    }

    public function commonCategoryId($value)
    {
        return FilterClauses::linkedId($this->builder, 'common_category_id', \NextDeveloper\Commons\Database\Models\Categories::class, $value);
    }

        //  This is an alias function of commonCategory
    public function common_category_id($value)
    {
        return $this->commonCategoryId($value);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE










}
