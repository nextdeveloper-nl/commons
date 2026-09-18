<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;
use NextDeveloper\Commons\Database\Filters\FilterClauses;
        

/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class MediaQueryFilter extends AbstractQueryFilter
{
    /**
     * Filter by tags
     *
     * @param  $values
     * @return Builder
     */
    public function tags($values)
    {
        return FilterClauses::tags($this->builder, $values);
    }

    /**
     * @var Builder
     */
    protected $builder;
    
    public function objectType($value)
    {
        return FilterClauses::objectType($this->builder, $value);
    }

    /**
     * Files of one or more records (comma separated uuids of the object_type sent along), so the
     * files of a whole page of records come back in one request.
     */
    public function objectId($value)
    {
        return FilterClauses::objectId(
            $this->builder,
            $this->request->get('object_type', $this->request->get('objectType')),
            $value
        );
    }

    //  This is an alias function of objectId
    public function object_id($value)
    {
        return $this->objectId($value);
    }

        //  This is an alias function of objectType
    public function object_type($value)
    {
        return $this->objectType($value);
    }
        
    public function collectionName($value)
    {
        return $this->builder->where('collection_name', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of collectionName
    public function collection_name($value)
    {
        return $this->collectionName($value);
    }
        
    public function name($value)
    {
        return $this->builder->where('name', 'ilike', '%' . $value . '%');
    }

        
    public function cdnUrl($value)
    {
        return $this->builder->where('cdn_url', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of cdnUrl
    public function cdn_url($value)
    {
        return $this->cdnUrl($value);
    }
        
    public function fileName($value)
    {
        return $this->builder->where('file_name', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of fileName
    public function file_name($value)
    {
        return $this->fileName($value);
    }
        
    public function mimeType($value)
    {
        return $this->builder->where('mime_type', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of mimeType
    public function mime_type($value)
    {
        return $this->mimeType($value);
    }
        
    public function disk($value)
    {
        return $this->builder->where('disk', 'ilike', '%' . $value . '%');
    }

    
    public function size($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
            $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('size', $operator, $value);
    }

    
    public function orderColumn($value)
    {
        $operator = substr($value, 0, 1);

        if ($operator != '<' || $operator != '>') {
            $operator = '=';
        } else {
            $value = substr($value, 1);
        }

        return $this->builder->where('order_column', $operator, $value);
    }

        //  This is an alias function of orderColumn
    public function order_column($value)
    {
        return $this->orderColumn($value);
    }
    
    public function createdAtStart($date)
    {
        return $this->builder->where('created_at', '>=', $date);
    }

    public function createdAtEnd($date)
    {
        return $this->builder->where('created_at', '<=', $date);
    }

    //  This is an alias function of createdAt
    public function created_at_start($value)
    {
        return $this->createdAtStart($value);
    }

    //  This is an alias function of createdAt
    public function created_at_end($value)
    {
        return $this->createdAtEnd($value);
    }

    public function updatedAtStart($date)
    {
        return $this->builder->where('updated_at', '>=', $date);
    }

    public function updatedAtEnd($date)
    {
        return $this->builder->where('updated_at', '<=', $date);
    }

    //  This is an alias function of updatedAt
    public function updated_at_start($value)
    {
        return $this->updatedAtStart($value);
    }

    //  This is an alias function of updatedAt
    public function updated_at_end($value)
    {
        return $this->updatedAtEnd($value);
    }

    public function deletedAtStart($date)
    {
        return $this->builder->where('deleted_at', '>=', $date);
    }

    public function deletedAtEnd($date)
    {
        return $this->builder->where('deleted_at', '<=', $date);
    }

    //  This is an alias function of deletedAt
    public function deleted_at_start($value)
    {
        return $this->deletedAtStart($value);
    }

    //  This is an alias function of deletedAt
    public function deleted_at_end($value)
    {
        return $this->deletedAtEnd($value);
    }

    public function iamAccountId($value)
    {
        return FilterClauses::linkedId($this->builder, 'iam_account_id', \NextDeveloper\IAM\Database\Models\Accounts::class, $value);
    }

    //  This is an alias function of iamAccountId
    public function iam_account_id($value)
    {
        return $this->iamAccountId($value);
    }

    
    public function iamUserId($value)
    {
        return FilterClauses::linkedId($this->builder, 'iam_user_id', \NextDeveloper\IAM\Database\Models\Users::class, $value);
    }

    //  This is an alias function of iamUserId
    public function iam_user_id($value)
    {
        return $this->iamUserId($value);
    }

    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE









}
