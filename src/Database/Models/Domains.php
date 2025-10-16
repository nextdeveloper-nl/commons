<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use NextDeveloper\Commons\Common\Cache\Traits\CleanCache;
use NextDeveloper\Commons\Database\Observers\DomainsObserver;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Traits\Taggable;
use NextDeveloper\Commons\Database\Traits\UuidId;
use NextDeveloper\Commons\Database\Traits\HasStates;
use Illuminate\Notifications\Notifiable;
use NextDeveloper\Commons\Database\Traits\RunAsAdministrator;

/**
 * Domains model.
 *
 * @package  NextDeveloper\Commons\Database\Models
 * @property integer $id
 * @property string $uuid
 * @property integer $iam_account_id
 * @property string $name
 * @property boolean $is_active
 * @property boolean $is_local_domain
 * @property boolean $is_locked
 * @property boolean $is_shared_domain
 * @property boolean $is_validated
 * @property array $tags
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property string $description
 * @property boolean $is_tld
 */
class Domains extends Model
{
    use Filterable, UuidId, CleanCache, Taggable, HasStates, RunAsAdministrator;
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'common_domains';


    /**
     @var array
     */
    protected $guarded = [];

    protected $fillable = [
            'iam_account_id',
            'name',
            'is_active',
            'is_local_domain',
            'is_locked',
            'is_shared_domain',
            'is_validated',
            'tags',
            'description',
            'is_tld',
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
    'is_active' => 'boolean',
    'is_local_domain' => 'boolean',
    'is_locked' => 'boolean',
    'is_shared_domain' => 'boolean',
    'is_validated' => 'boolean',
    'tags' => \NextDeveloper\Commons\Database\Casts\TextArray::class,
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'deleted_at' => 'datetime',
    'description' => 'string',
    'is_tld' => 'boolean',
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

    public function accounts() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\NextDeveloper\IAM\Database\Models\Accounts::class);
    }
    
    public function categories() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\NextDeveloper\Commons\Database\Models\Categories::class);
    }

    public function disposableEmails() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\NextDeveloper\Commons\Database\Models\DisposableEmails::class);
    }

    public function networks() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\NextDeveloper\IAAS\Database\Models\Networks::class);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    public function domainsDns() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\NextDeveloper\Intelligence\Database\Models\DomainsDns::class);
    }

    public function domains() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\NextDeveloper\Intelligence\Database\Models\Domains::class);
    }

    public function domainsIps() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\NextDeveloper\Intelligence\Database\Models\DomainsIps::class);
    }

    public function emailAddresses() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\NextDeveloper\Intelligence\Database\Models\EmailAddresses::class);
    }

    public function domainReports() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\NextDeveloper\Intelligence\Database\Models\DomainReports::class);
    }

    public function websiteContents() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\NextDeveloper\Intelligence\Database\Models\WebsiteContents::class);
    }



}
