<?php

namespace NextDeveloper\Commons\Database\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Filters of GET /commons/command-logs. Every filter is an exact match except the date range.
 * Example: ?module=monitoring&operation=delete&created_at_start=2026-11-01
 */
class CommandLogsQueryFilter extends AbstractQueryFilter
{
    /**
     * @var Builder
     */
    protected $builder;

    public function module($value)
    {
        return $this->builder->where('module', $value);
    }

    public function resource($value)
    {
        return $this->builder->where('resource', $value);
    }

    public function operation($value)
    {
        return $this->builder->where('operation', $value);
    }

    public function action($value)
    {
        return $this->builder->where('action', $value);
    }

    public function objectType($value)
    {
        return $this->builder->where('object_type', $value);
    }

    public function objectId($value)
    {
        return $this->builder->where('object_id', $value);
    }

    public function source($value)
    {
        return $this->builder->where('source', $value);
    }

    public function status($value)
    {
        return $this->builder->where('status', $value);
    }

    /** The user, by uuid (public ids are never integer ids). */
    public function iamUserId($value)
    {
        $user = \NextDeveloper\IAM\Database\Models\Users::where('uuid', $value)->first();

        return $this->builder->where('iam_user_id', $user ? $user->id : null);
    }

    //  Snake case aliases: the filter name is the query key as sent, and the panel sends camelCase while the API
    //  documentation (and other clients) use snake_case, so both forms are accepted.
    public function object_type($value)
    {
        return $this->objectType($value);
    }

    public function object_id($value)
    {
        return $this->objectId($value);
    }

    public function iam_user_id($value)
    {
        return $this->iamUserId($value);
    }

    public function createdAtStart($date)
    {
        return $this->builder->where('created_at', '>=', $date);
    }

    public function createdAtEnd($date)
    {
        return $this->builder->where('created_at', '<=', $date);
    }

    //  Snake case aliases, same as the other filters
    public function created_at_start($value)
    {
        return $this->createdAtStart($value);
    }

    public function created_at_end($value)
    {
        return $this->createdAtEnd($value);
    }
}
