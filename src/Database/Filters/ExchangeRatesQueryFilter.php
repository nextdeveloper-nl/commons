<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;


/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class ExchangeRatesQueryFilter extends AbstractQueryFilter
{

    /**
     * @var Builder
     */
    protected $builder;

    public function code($value)
    {
        return $this->builder->where('code', 'ilike', '%' . $value . '%');
    }

    public function referenceCurrencyCode($value)
    {
        return $this->builder->where('reference_currency_code', 'like', '%' . $value . '%');
    }

    public function source($value)
    {
        return $this->builder->where('source', 'like', '%' . $value . '%');
    }

    public function localCurrencyCode($value)
    {
        return $this->builder->where('local_currency_code', 'like', '%' . $value . '%');
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
