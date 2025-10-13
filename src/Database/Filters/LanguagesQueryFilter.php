<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;


/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class LanguagesQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;
    
    public function name($value)
    {
        return $this->builder->where('name', 'ilike', '%' . $value . '%');
    }

        
    public function nativeName($value)
    {
        return $this->builder->where('native_name', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of nativeName
    public function native_name($value)
    {
        return $this->nativeName($value);
    }
    
    public function isDefault($value)
    {
        return $this->builder->where('is_default', $value);
    }

        //  This is an alias function of isDefault
    public function is_default($value)
    {
        return $this->isDefault($value);
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
