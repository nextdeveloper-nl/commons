<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class DomainsQueryFilter extends AbstractQueryFilter
{
    /**
     * Filter by tags
     *
     * @param  $values
     * @return Builder
     */
    public function tags($values)
    {
        $tags = explode(',', $values);

        $search = '';

        for($i = 0; $i < count($tags); $i++) {
            $search .= "'" . trim($tags[$i]) . "',";
        }

        $search = substr($search, 0, -1);

        return $this->builder->whereRaw('tags @> ARRAY[' . $search . ']');
    }

    /**
     * @var Builder
     */
    protected $builder;

    public function name($value)
    {
        return $this->builder->where('name', 'ilike', '%' . $value . '%');
    }

    public function description($value)
    {
        return $this->builder->where('description', 'ilike', '%' . $value . '%');
    }

    public function isActive($value)
    {
        if(!is_bool($value)) {
            $value = false;
        }

        return $this->builder->where('is_active', $value);
    }

        //  This is an alias function of isActive
    public function is_active($value)
    {
        return $this->isActive($value);
    }

    public function isLocalDomain($value)
    {
        if(!is_bool($value)) {
            $value = false;
        }

        return $this->builder->where('is_local_domain', $value);
    }

        //  This is an alias function of isLocalDomain
    public function is_local_domain($value)
    {
        return $this->isLocalDomain($value);
    }

    public function isLocked($value)
    {
        if(!is_bool($value)) {
            $value = false;
        }

        return $this->builder->where('is_locked', $value);
    }

        //  This is an alias function of isLocked
    public function is_locked($value)
    {
        return $this->isLocked($value);
    }

    public function isSharedDomain($value)
    {
        if(!is_bool($value)) {
            $value = false;
        }

        return $this->builder->where('is_shared_domain', $value);
    }

        //  This is an alias function of isSharedDomain
    public function is_shared_domain($value)
    {
        return $this->isSharedDomain($value);
    }

    public function isValidated($value)
    {
        if(!is_bool($value)) {
            $value = false;
        }

        return $this->builder->where('is_validated', $value);
    }

        //  This is an alias function of isValidated
    public function is_validated($value)
    {
        return $this->isValidated($value);
    }

    public function isTld($value)
    {
        if(!is_bool($value)) {
            $value = false;
        }

        return $this->builder->where('is_tld', $value);
    }

        //  This is an alias function of isTld
    public function is_tld($value)
    {
        return $this->isTld($value);
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

    public function iamAccountId($value)
    {
            $iamAccount = \NextDeveloper\IAM\Database\Models\Accounts::where('uuid', $value)->first();

        if($iamAccount) {
            return $this->builder->where('iam_account_id', '=', $iamAccount->id);
        }
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
