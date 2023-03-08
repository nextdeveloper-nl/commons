<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CountryQueryFilter extends AbstractQueryFilter
{
    /**
    * @var Builder
    */
    protected $builder;
    
    public function code($value)
    {
        return $this->builder->where('code', 'like', '%' . $value . '%');
    }
    
    public function locale($value)
    {
        return $this->builder->where('locale', 'like', '%' . $value . '%');
    }
    
    public function name($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }
    
    public function currencyCode($value)
    {
        return $this->builder->where('currencyCode', 'like', '%' . $value . '%');
    }
    
    public function phoneCode($value)
    {
        return $this->builder->where('phoneCode', 'like', '%' . $value . '%');
    }
    
    public function continentName($value)
    {
        return $this->builder->where('continentName', 'like', '%' . $value . '%');
    }
    
    public function continentCode($value)
    {
        return $this->builder->where('continentCode', 'like', '%' . $value . '%');
    }

    public function rate($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
           $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('rate', $operator, $value);
    }
    
    public function percentage($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
           $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('percentage', $operator, $value);
    }
    
    public function geoNameCode($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
           $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('geoNameCode', $operator, $value);
    }
    
}
