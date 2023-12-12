<?php

namespace NextDeveloper\Commons\Database\GlobalScopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LimitScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        /**
         * Here the user will only be able to run this query only if the table name starts with 'crm_*' and
         * the owner of the model is the user itself.
         */
        $rowCount = $model->perPage;

        //  Is null
        if(!$rowCount)
            $rowCount = 20;

        if(request()->has('rowCount')) {
            $rowCount = intval( request()->get('rowCount') );
        }

        return $builder->limit($rowCount);
    }
}
