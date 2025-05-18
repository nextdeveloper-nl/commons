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

    public function objectType($value)
    {
        return $this->builder->where('object_type', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of objectType
    public function object_type($value)
    {
        return $this->objectType($value);
    }

    public function name($value)
    {
        return $this->builder->where('name', 'ilike', '%' . $value . '%');
    }

    public function line1($value)
    {
        return $this->builder->where('line1', 'ilike', '%' . $value . '%');
    }

    public function line2($value)
    {
        return $this->builder->where('line2', 'ilike', '%' . $value . '%');
    }

    public function city($value)
    {
        return $this->builder->where('city', 'ilike', '%' . $value . '%');
    }

    public function state($value)
    {
        return $this->builder->where('state', 'ilike', '%' . $value . '%');
    }

    public function stateCode($value)
    {
        return $this->builder->where('state_code', 'ilike', '%' . $value . '%');
    }


        //  This is an alias function of stateCode
    public function state_code($value)
    {
        return $this->stateCode($value);
    }

    public function postcode($value)
    {
        return $this->builder->where('postcode', 'ilike', '%' . $value . '%');
    }

    public function emailAddress($value)
    {
        return $this->builder->where('email_address', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of emailAddress
    public function email_address($value)
    {
        return $this->emailAddress($value);
    }

    public function isInvoiceAddress($value)
    {
        if(!is_bool($value)) {
            $value = false;
        }

        return $this->builder->where('is_invoice_address', $value);
    }

        //  This is an alias function of isInvoiceAddress
    public function is_invoice_address($value)
    {
        return $this->isInvoiceAddress($value);
    }

    public function createdAtStart($date)
    {
        return $this->builder->where('created_at', '>=', $date);
    }

    public function createdAtEnd($date)
    {
        return $this->builder->where('created_at', '<=', $date);
    }

    public function updatedAtStart($date)
    {
        return $this->builder->where('updated_at', '>=', $date);
    }

    public function updatedAtEnd($date)
    {
        return $this->builder->where('updated_at', '<=', $date);
    }

    public function deletedAtStart($date)
    {
        return $this->builder->where('deleted_at', '>=', $date);
    }

    public function deletedAtEnd($date)
    {
        return $this->builder->where('deleted_at', '<=', $date);
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

    public function iamAccountId($value)
    {
            $iamAccount = \NextDeveloper\IAM\Database\Models\Accounts::where('uuid', $value)->first();

        if($iamAccount) {
            return $this->builder->where('iam_account_id', '=', $iamAccount->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
