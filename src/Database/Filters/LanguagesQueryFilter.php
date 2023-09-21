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
    
    public function iso6391Code($value)
    {
        return $this->builder->where('iso_639_1_code', 'like', '%' . $value . '%');
    }
    
    public function iso6392Code($value)
    {
        return $this->builder->where('iso_639_2_code', 'like', '%' . $value . '%');
    }
    
    public function iso6392bCode($value)
    {
        return $this->builder->where('iso_639_2b_code', 'like', '%' . $value . '%');
    }
    
    public function code($value)
    {
        return $this->builder->where('code', 'like', '%' . $value . '%');
    }
    
    public function codeV2($value)
    {
        return $this->builder->where('code_v2', 'like', '%' . $value . '%');
    }
    
    public function codeV2b($value)
    {
        return $this->builder->where('code_v2b', 'like', '%' . $value . '%');
    }
    
    public function name($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }
    
    public function nativeName($value)
    {
        return $this->builder->where('native_name', 'like', '%' . $value . '%');
    }

    public function isDefault()
    {
        return $this->builder->where('is_default', true);
    }
    
    public function isActive()
    {
        return $this->builder->where('is_active', true);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}