<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
        

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class AddressesQueryFilter extends AbstractQueryFilter
{
    /**
    * @var Builder
    */
    protected $builder;
    
    public function addressableType($value)
    {
        return $this->builder->where('addressable_type', 'like', '%' . $value . '%');
    }
    
    public function name($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }
    
    public function line1($value)
    {
        return $this->builder->where('line1', 'like', '%' . $value . '%');
    }
    
    public function line2($value)
    {
        return $this->builder->where('line2', 'like', '%' . $value . '%');
    }
    
    public function city($value)
    {
        return $this->builder->where('city', 'like', '%' . $value . '%');
    }
    
    public function state($value)
    {
        return $this->builder->where('state', 'like', '%' . $value . '%');
    }
    
    public function stateCode($value)
    {
        return $this->builder->where('state_code', 'like', '%' . $value . '%');
    }
    
    public function postcode($value)
    {
        return $this->builder->where('postcode', 'like', '%' . $value . '%');
    }
    
    public function emailAddress($value)
    {
        return $this->builder->where('email_address', 'like', '%' . $value . '%');
    }

    public function isInvoiceAddress()
    {
        return $this->builder->where('is_invoice_address', true);
    }
    
    public function createdAtStart($date) 
    {
        return $this->builder->where( 'created_at', '>=', $date );
    }

    public function createdAtEnd($date) 
    {
        return $this->builder->where( 'created_at', '<=', $date );
    }

    public function updatedAtStart($date) 
    {
        return $this->builder->where( 'updated_at', '>=', $date );
    }

    public function updatedAtEnd($date) 
    {
        return $this->builder->where( 'updated_at', '<=', $date );
    }

    public function deletedAtStart($date) 
    {
        return $this->builder->where( 'deleted_at', '>=', $date );
    }

    public function deletedAtEnd($date) 
    {
        return $this->builder->where( 'deleted_at', '<=', $date );
    }

    public function addressableId($value)
    {
        $addressable = Addressable::where('uuid', $value)->first();

        if($addressable) {
            return $this->builder->where('addressable_id', '=', $addressable->id);
        }
    }

    public function commonCountryId($value)
    {
        $commonCountry = CommonCountry::where('uuid', $value)->first();

        if($commonCountry) {
            return $this->builder->where('common_country_id', '=', $commonCountry->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n
}