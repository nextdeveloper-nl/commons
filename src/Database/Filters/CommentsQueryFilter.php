<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;


/**
 * This class automatically puts where clause on database so that use can filter
 * data returned from the query.
 */
class CommentsQueryFilter extends AbstractQueryFilter
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

    public function body($value)
    {
        return $this->builder->where('body', 'ilike', '%' . $value . '%');
    }

    public function object_id($value)
    {
        return $this->builder->where('object_uuid', '=', $value);
    }

    public function objectId($value)
    {
        return $this->object_id($value);
    }

    public function objectType($value)
    {
        $exploded = explode('\\', $value);

        if(count($exploded) != 3) {
            //  We need to search by suffix
            throw new \Exception('Invalid object type');
        }

        $value = $exploded[0] . '\\' . $exploded[1] . '\\Database\\Models\\' . $exploded[2];

        return $this->builder->where('object_type', 'ilike', '%' . $value . '%');
    }

        //  This is an alias function of objectType
    public function object_type($value)
    {
        return $this->objectType($value);
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

    public function iamUserId($value)
    {
            $iamUser = \NextDeveloper\IAM\Database\Models\Users::where('uuid', $value)->first();

        if($iamUser) {
            return $this->builder->where('iam_user_id', '=', $iamUser->id);
        }
    }

    public function parentId($value)
    {
            return $this->builder->where('parent_id', '=', $value);
    }

        //  This is an alias function of parent
    public function parent_id($value)
    {
        return $this->parent($value);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
