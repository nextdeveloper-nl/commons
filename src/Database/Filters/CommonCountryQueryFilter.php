<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
    

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CommonCountryQueryFilter extends AbstractQueryFilter
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
        return $this->builder->where('currency_code', 'like', '%' . $value . '%');
    }
    
    public function phoneCode($value)
    {
        return $this->builder->where('phone_code', 'like', '%' . $value . '%');
    }
    
    public function continentName($value)
    {
        return $this->builder->where('continent_name', 'like', '%' . $value . '%');
    }
    
    public function continentCode($value)
    {
        return $this->builder->where('continent_code', 'like', '%' . $value . '%');
    }

    public function vatRate($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
           $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('vat_rate', $operator, $value);
    }
    
    public function isActive()
    {
        return $this->builder->where('is_active', true);
    }
    
    public function geoNameId($value)
    {
        $geoName = GeoName::where('uuid', $value)->first();

        if($geoName) {
            return $this->builder->where('geo_name_id', '=', $geoName->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}