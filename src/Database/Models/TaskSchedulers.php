<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Common\Cache\Traits\CleanCache;
use NextDeveloper\Commons\Database\Observers\TaskSchedulersObserver;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Traits\Taggable;
use NextDeveloper\Commons\Database\Traits\UuidId;
use NextDeveloper\Commons\Database\Traits\HasStates;
use Illuminate\Notifications\Notifiable;
use NextDeveloper\Commons\Database\Traits\RunAsAdministrator;

/**
 * TaskSchedulers model.
 *
 * @package  NextDeveloper\Commons\Database\Models
 * @property integer $id
 * @property string $uuid
 * @property string $name
 * @property string $description
 * @property integer $day_of_month
 * @property integer $day_of_week
 * @property $time_of_day
 * @property string $schedule_type
 * @property \Carbon\Carbon $next_run
 * @property string $object_type
 * @property integer $object_id
 * @property integer $common_available_action_id
 * @property $params
 * @property string $cron_expression
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $timezone
 */
class TaskSchedulers extends Model
{
    use Filterable, UuidId, CleanCache, Taggable, HasStates, RunAsAdministrator;

    public $timestamps = true;

    protected $table = 'common_task_schedulers';


    /**
     * @var array
     */
    protected $guarded = [];

    protected $fillable = [
        'name',
        'description',
        'day_of_month',
        'day_of_week',
        'time_of_day',
        'schedule_type',
        'next_run_at',
        'object_type',
        'object_id',
        'common_available_action_id',
        'params',
        'timezone',
        'cron_expression'
    ];

    /**
     * Here we have the fulltext fields. We can use these for fulltext search if enabled.
     */
    protected $fullTextFields = [

    ];

    /**
     * @var array
     */
    protected $appends = [

    ];

    /**
     * We are casting fields to objects so that we can work on them better
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'day_of_month' => 'integer',
        'day_of_week' => 'integer',
        'schedule_type' => 'string',
        'next_run_at' => 'datetime',
        'object_type' => 'string',
        'object_id' => 'integer',
        'common_available_action_id' => 'integer',
        'params' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'timezone' => 'string',
        'cron_expression' => 'string',
    ];

    /**
     * We are casting data fields.
     *
     * @var array
     */
    protected $dates = [
        'next_run_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $with = [

    ];

    /**
     * @var int
     */
    protected $perPage = 20;

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        //  We create and add Observer even if we wont use it.
        parent::observe(TaskSchedulersObserver::class);

        self::registerScopes();
    }

    public static function registerScopes()
    {
        $globalScopes = config('commons.scopes.global');
        $modelScopes = config('commons.scopes.common_task_schedulers');

        if (!$modelScopes) {
            $modelScopes = [];
        }
        if (!$globalScopes) {
            $globalScopes = [];
        }

        $scopes = array_merge(
            $globalScopes,
            $modelScopes
        );

        if ($scopes) {
            foreach ($scopes as $scope) {
                static::addGlobalScope(app($scope));
            }
        }
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    /**
     * Get the available action associated with this task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function availableAction()
    {
        return $this->belongsTo(AvailableActions::class, 'common_available_action_id');
    }

    /**
     * Check if the task is due to run
     *
     * @return bool
     */
    public function isDue(): bool
    {
        // If the next run is not set, then the task is not due
        if (!$this->next_run_at) {
            return false;
        }

        // If the last run is not set, then the task is due
        if (!$this->last_run_at) {
            return $this->next_run_at->isPast();
        }

        // If the last run is before the next run and the next run is in the past, then the task is due
        return $this->last_run_at->lt($this->next_run_at) && $this->next_run_at->isPast();
    }


}
