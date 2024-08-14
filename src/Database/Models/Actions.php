<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Traits\HasStates;
use NextDeveloper\Commons\Database\Observers\ActionsObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;
use NextDeveloper\Commons\Common\Cache\Traits\CleanCache;
use NextDeveloper\Commons\Database\Traits\Taggable;

/**
 * Actions model.
 *
 * @package  NextDeveloper\Commons\Database\Models
 * @property integer $id
 * @property string $uuid
 * @property string $action
 * @property integer $progress
 * @property integer $runtime
 * @property integer $object_id
 * @property string $object_type
 * @property integer $iam_user_id
 * @property integer $iam_account_id
 * @property array $tags
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Actions extends Model
{
    use Filterable, UuidId, CleanCache, Taggable, HasStates;


    public $timestamps = true;

    protected $table = 'common_actions';


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
            'tags',
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
    'id' => 'integer',
    'action' => 'string',
    'progress' => 'integer',
    'runtime' => 'integer',
    'object_id' => 'integer',
    'object_type' => 'string',
    'tags' => \NextDeveloper\Commons\Database\Casts\TextArray::class,
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
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
        parent::observe(ActionsObserver::class);

        self::registerScopes();
    }

    public static function registerScopes()
    {
        $globalScopes = config('commons.scopes.global');
        $modelScopes = config('commons.scopes.common_actions');

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
