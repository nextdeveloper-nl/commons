<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;


/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class MetaQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;

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

    public function key($value)
    {
        return $this->builder->where('key', 'ilike', '%' . $value . '%');
    }


    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE









}
