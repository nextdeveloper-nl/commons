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
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }
    
    public function code($value)
    {
        return $this->builder->where('code', 'like', '%' . $value . '%');
    }
    
    public function latitude($value)
    {
        return $this->builder->where('latitude', 'like', '%' . $value . '%');
    }
    
    public function longitude($value)
    {
        return $this->builder->where('longitude', 'like', '%' . $value . '%');
    }
    
    public function type($value)
    {
        return $this->builder->where('type', 'like', '%' . $value . '%');
    }

    public function isActive()
    {
        return $this->builder->where('is_active', true);
    }

    public function commonCountryId($value)
    {
            $commonCountry = \NextDeveloper\Commons\Database\Models\Countries::where('uuid', $value)->first();

        if($commonCountry) {
            return $this->builder->where('common_country_id', '=', $commonCountry->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE




}
