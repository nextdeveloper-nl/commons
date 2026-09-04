<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use NextDeveloper\Commons\Common\Cache\Traits\CleanCache;
use NextDeveloper\Commons\Database\Observers\KeywordsObserver;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Traits\Taggable;
use NextDeveloper\Commons\Database\Traits\UuidId;
use NextDeveloper\Commons\Database\Traits\HasStates;
use Illuminate\Notifications\Notifiable;
use NextDeveloper\Commons\Database\Traits\RunAsAdministrator;
use NextDeveloper\Commons\Database\Traits\HasObject;

/**
 * Keywords model.
 *
 * @package  NextDeveloper\Commons\Database\Models
 * @property integer $id
 * @property string $uuid
 * @property string $name
 */
class Keywords extends Model
{
    use Filterable, UuidId, CleanCache, Taggable, HasStates, RunAsAdministrator, HasObject;

    public $timestamps = false;

    protected $table = 'common_keywords';


    /**
     @var array
     */
    protected $guarded = [];

    protected $fillable = [
            'name',
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
    'name' => 'string',
    ];

    /**
     We are casting data fields.
     *
     @var array
     */
    protected $dates = [

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

        self::registerScopes();
    }

    /**
     * Registers the observer once the model has finished booting.
     *
     * Registering it inside boot() instantiates the model while it is still booting,
     * which Laravel 12+ rejects with a LogicException.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();

        //  We create and add Observer even if we wont use it.
        static::observe(KeywordsObserver::class);
    }

    public static function registerScopes()
    {
        $globalScopes = config('commons.scopes.global');
        $modelScopes = config('commons.scopes.common_keywords');

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
