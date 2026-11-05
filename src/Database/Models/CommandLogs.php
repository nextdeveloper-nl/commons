<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * CommandLogs model: the project-wide command history (who did what, in any module).
 *
 * Append-only: rows are written by CommandLogsService (through WriteCommandLogJob) and never updated. The model is kept
 * lean on purpose (no tags, states, cache invalidation): a row is a record of something that already happened.
 *
 * @package  NextDeveloper\Commons\Database\Models
 * @property integer $id
 * @property string $uuid
 * @property integer $iam_account_id
 * @property integer $iam_user_id
 * @property string $module
 * @property string $resource
 * @property string $operation
 * @property string $action
 * @property string $object_type
 * @property string $object_id
 * @property string $source
 * @property string $http_method
 * @property string $path
 * @property string $request_id
 * @property string $ip_address
 * @property string $user_agent
 * @property array $request
 * @property array $context
 * @property string $status
 * @property integer $http_status
 * @property string $error
 * @property \Carbon\Carbon $created_at
 */
class CommandLogs extends Model
{
    use Filterable, UuidId;

    public $timestamps = false;

    protected $table = 'common_command_logs';

    protected $guarded = [];

    protected $fillable = [
        'iam_account_id',
        'iam_user_id',
        'module',
        'resource',
        'operation',
        'action',
        'object_type',
        'object_id',
        'source',
        'http_method',
        'path',
        'request_id',
        'ip_address',
        'user_agent',
        'request',
        'context',
        'status',
        'http_status',
        'error',
        'created_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'iam_account_id' => 'integer',
        'iam_user_id' => 'integer',
        'request' => 'array',
        'context' => 'array',
        'http_status' => 'integer',
        'created_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
    ];

    protected $perPage = 20;

    public static function boot()
    {
        parent::boot();

        self::registerScopes();
    }

    /**
     * Same scopes as every other Commons model: AuthorizationScope makes an account see only its own history.
     * Writes are done by CommandLogsService inside UserHelper::withRolesCheckBypassed where the actor has no role.
     */
    public static function registerScopes()
    {
        $globalScopes = config('commons.scopes.global') ?: [];
        $modelScopes = config('commons.scopes.common_command_logs') ?: [];

        foreach (array_merge($globalScopes, $modelScopes) as $scope) {
            static::addGlobalScope(app($scope));
        }
    }
}
