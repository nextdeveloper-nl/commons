<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
    

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CountryStatesQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;
    
    public function name($value)
    {
        return $this->builder->where('name', 'ilike', '%' . $value . '%');
    }

        
    public function code($value)
    {
        return $this->builder->where('code', 'ilike', '%' . $value . '%');
    }

        
    public function latitude($value)
    {
        return $this->builder->where('latitude', 'ilike', '%' . $value . '%');
    }

        
    public function longitude($value)
    {
        return $this->builder->where('longitude', 'ilike', '%' . $value . '%');
    }

        
    public function type($value)
    {
        return $this->builder->where('type', 'ilike', '%' . $value . '%');
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
