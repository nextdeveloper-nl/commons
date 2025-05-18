<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;


/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class ExchangeRatesQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;

    public function code($value)
    {
        return $this->builder->where('code', 'ilike', '%' . $value . '%');
    }


    public function lastModifiedStart($date)
    {
        return $this->builder->where('last_modified', '>=', $date);
    }

    public function lastModifiedEnd($date)
    {
        return $this->builder->where('last_modified', '<=', $date);
    }

    //  This is an alias function of lastModified
    public function last_modified_start($value)
    {
        return $this->lastModifiedStart($value);
    }

    //  This is an alias function of lastModified
    public function last_modified_end($value)
    {
        return $this->lastModifiedEnd($value);
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

    public function commonCountryId($value)
    {
            $commonCountry = \NextDeveloper\Commons\Database\Models\Countries::where('uuid', $value)->first();

        if($commonCountry) {
            return $this->builder->where('common_country_id', '=', $commonCountry->id);
        }
    }

        //  This is an alias function of commonCountry
    public function common_country_id($value)
    {
        return $this->commonCountry($value);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE











}
