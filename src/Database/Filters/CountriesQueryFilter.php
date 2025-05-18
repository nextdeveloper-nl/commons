<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;


/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CountriesQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;

    public function code($value)
    {
        return $this->builder->where('code', 'ilike', '%' . $value . '%');
    }


    public function locale($value)
    {
        return $this->builder->where('locale', 'ilike', '%' . $value . '%');
    }


    public function name($value)
    {
        return $this->builder->where('name', 'ilike', '%' . $value . '%');
    }


    public function currencyCode($value)
    {
        return $this->builder->where('currency_code', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of currencyCode
    public function currency_code($value)
    {
        return $this->currencyCode($value);
    }

    public function phoneCode($value)
    {
        return $this->builder->where('phone_code', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of phoneCode
    public function phone_code($value)
    {
        return $this->phoneCode($value);
    }

    public function continentName($value)
    {
        return $this->builder->where('continent_name', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of continentName
    public function continent_name($value)
    {
        return $this->continentName($value);
    }

    public function continentCode($value)
    {
        return $this->builder->where('continent_code', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of continentCode
    public function continent_code($value)
    {
        return $this->continentCode($value);
    }

    public function geoNameIdentity($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
            $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('geo_name_identity', $operator, $value);
    }

        //  This is an alias function of geoNameIdentity
    public function geo_name_identity($value)
    {
        return $this->geoNameIdentity($value);
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

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE











}
