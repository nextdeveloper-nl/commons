<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\CountriesObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * Class Countries.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class Countries extends Model
{
    use Filterable, UuidId;


    public $timestamps = false;

    protected $table = 'common_countries';


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
    'id'                 => 'integer',
    'uuid'               => 'string',
    'code'               => 'string',
    'locale'             => 'string',
    'name'               => 'string',
    'currency_code'      => 'string',
    'phone_code'         => 'string',
    'vat_rate'           => 'double',
    'continent_name'     => 'string',
    'continent_code'     => 'string',
    'geo_name_identitiy' => 'integer',
    'is_active'          => 'boolean',
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

        //  We create and add Observer even if we wont use it.
        parent::observe(CountriesObserver::class);

        self::registerScopes();
    }

    public static function registerScopes()
    {
        $globalScopes = config('commons.scopes.global');
        $modelScopes = config('commons.scopes.common_countries');

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

    public function addresses()
    {
        return $this->hasMany(\NextDeveloper\Commons\Database\Models\Addresses::class);
    }

    public function exchangeRates()
    {
        return $this->hasMany(\NextDeveloper\Commons\Database\Models\ExchangeRates::class);
    }

    public function users()
    {
        return $this->hasMany(\NextDeveloper\IAM\Database\Models\Users::class);
    }

    public function products()
    {
        return $this->hasMany(\NextDeveloper\Marketplace\Database\Models\Products::class);
    }

    public function datacenters()
    {
        return $this->hasMany(\NextDeveloper\IAAS\Database\Models\Datacenters::class);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n
}