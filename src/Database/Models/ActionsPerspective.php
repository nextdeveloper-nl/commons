<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Traits\HasStates;
use NextDeveloper\Commons\Database\Observers\ActionsPerspectiveObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;
use NextDeveloper\Commons\Common\Cache\Traits\CleanCache;
use NextDeveloper\Commons\Database\Traits\Taggable;

/**
 * ActionsPerspective model.
 *
 * @package  NextDeveloper\Commons\Database\Models
 * @property string $uuid
 * @property string $action
 * @property integer $progress
 * @property integer $runtime
 * @property integer $object_id
 * @property string $object_type
 * @property integer $iam_user_id
 * @property integer $iam_account_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $ca_uuid
 * @property $log
 * @property integer $subaction_runtime
 */
class ActionsPerspective extends Model
{
    use Filterable, CleanCache, Taggable;
    use UuidId;


    public $timestamps = true;

    public $incrementing = false;



    protected $table = 'common_actions_perspective';


    /**
     @var array
     */
    protected $guarded = [];

    protected $fillable = [
            'action',
            'progress',
            'runtime',
            'object_id',
            'object_type',
            'iam_user_id',
            'iam_account_id',
            'ca_uuid',
            'log',
            'subaction_runtime',
    ];

    /**
      Here we have the fulltext fields. We can use these for fulltext search if enabled.
     */
    protected $fullTextFields = [

    ];

    /**
     @var array
     */
    protected $appends = [

    ];

    /**
     We are casting fields to objects so that we can work on them better
     *
     @var array
     */
    protected $casts = [
    'action' => 'string',
    'progress' => 'integer',
    'runtime' => 'integer',
    'object_id' => 'integer',
    'object_type' => 'string',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'log' => 'array',
    'subaction_runtime' => 'integer',
    ];

    /**
     We are casting data fields.
     *
     @var array
     */
    protected $dates = [
    'created_at',
    'updated_at',
    ];

    /**
     @var array
     */
    protected $with = [

    ];

    /**
     @var int
     */
    protected $perPage = 20;

    /**
     @return void
     */
    public static function boot()
    {
        parent::boot();

        //  We create and add Observer even if we wont use it.
        parent::observe(ActionsPerspectiveObserver::class);

        self::registerScopes();
    }

    public static function registerScopes()
    {
        $globalScopes = config('commons.scopes.global');
        $modelScopes = config('commons.scopes.common_actions_perspective');

        if(!$modelScopes) { $modelScopes = [];
        }
        if (!$globalScopes) { $globalScopes = [];
        }

        $scopes = array_merge(
            $globalScopes,
            $modelScopes
        );

        if($scopes) {
            foreach ($scopes as $scope) {
                static::addGlobalScope(app($scope));
            }
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

















}
