<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * Maps to Laravel's core `failed_jobs` table — a global/system table, not
 * tenant-scoped. No global scopes registered; access control is enforced
 * entirely in FailedJobsController via an explicit system-admin check.
 */
class FailedJobs extends Model
{
    use UuidId;

    public $timestamps = false;

    protected $table = 'failed_jobs';

    protected $guarded = [];

    protected $casts = [
        'id'        => 'integer',
        'failed_at' => 'datetime',
    ];
}
