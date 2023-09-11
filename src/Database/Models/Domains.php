<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\DomainsObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * Class Domains.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class Domains extends Model
{
    use Filterable, UuidId;
    use SoftDeletes;


    public $timestamps = true;

    protected $table = 'common_domains';


    /**
     @var array
     */
    protected $guarded = [];

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
    'id'               => 'integer',
    'uuid'             => 'string',
    'iam_account_id'   => 'integer',
    'iam_user_id'      => 'integer',
    'name'             => 'string',
    'is_active'        => 'boolean',
    'is_local_domain'  => 'boolean',
    'is_locked'        => 'boolean',
    'is_shared_domain' => 'boolean',
    'is_validated'     => 'boolean',
    'created_at'       => 'datetime',
    'updated_at'       => 'datetime',
    'deleted_at'       => 'datetime',
    ];

    /**
     We are casting data fields.
     *
     @var array
     */
    protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
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
        parent::observe(DomainsObserver::class);

        self::registerScopes();
    }

    public static function registerScopes()
    {
        $globalScopes = config('commons.scopes.global');
        $modelScopes = config('commons.scopes.common_domains');

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

    public function categories()
    {
        return $this->hasMany(\NextDeveloper\Commons\Database\Models\Categories::class);
    }

    public function disposableEmails()
    {
        return $this->hasMany(\NextDeveloper\Commons\Database\Models\DisposableEmails::class);
    }

    public function accounts()
    {
        return $this->hasMany(\NextDeveloper\IAM\Database\Models\Accounts::class);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n
}