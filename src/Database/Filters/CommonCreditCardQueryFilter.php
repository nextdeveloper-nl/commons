<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
                use NextDeveloper\Accounts\Database\Models\User;
    

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CommonCreditCardQueryFilter extends AbstractQueryFilter
{
    /**
    * @var Builder
    */
    protected $builder;
    
    public function type($value)
    {
        return $this->builder->where('type', 'like', '%' . $value . '%');
    }
    
    public function ccHolderName($value)
    {
        return $this->builder->where('cc_holder_name', 'like', '%' . $value . '%');
    }
    
    public function ccNumber($value)
    {
        return $this->builder->where('cc_number', 'like', '%' . $value . '%');
    }
    
    public function ccMonth($value)
    {
        return $this->builder->where('cc_month', 'like', '%' . $value . '%');
    }
    
    public function ccYear($value)
    {
        return $this->builder->where('cc_year', 'like', '%' . $value . '%');
    }
    
    public function ccCvv($value)
    {
        return $this->builder->where('cc_cvv', 'like', '%' . $value . '%');
    }

    public function score($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
           $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('score', $operator, $value);
    }
    
    public function retryCount($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
           $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('retry_count', $operator, $value);
    }
    
    public function isDefault()
    {
        return $this->builder->where('is_default', true);
    }
    
    public function isValid()
    {
        return $this->builder->where('is_valid', true);
    }
    
    public function isActive()
    {
        return $this->builder->where('is_active', true);
    }
    
    public function is3dSecureEnabled()
    {
        return $this->builder->where('is_3d_secure_enabled', true);
    }
    
    public function lastRetryDateStart($date) 
    {
        return $this->builder->where( 'last_retry_date', '>=', $date );
    }

    public function lastRetryDateEnd($date) 
    {
        return $this->builder->where( 'last_retry_date', '<=', $date );
    }

    public function verificationDateStart($date) 
    {
        return $this->builder->where( 'verification_date', '>=', $date );
    }

    public function verificationDateEnd($date) 
    {
        return $this->builder->where( 'verification_date', '<=', $date );
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

    public function accountId($value)
    {
        $account = Account::where('uuid', $value)->first();

        if($account) {
            return $this->builder->where('iam_account_id', '=', $account->id);
        }
    }

    public function userId($value)
    {
        $user = User::where('uuid', $value)->first();

        if($user) {
            return $this->builder->where('iam_user_id', '=', $user->id);
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}