<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Observers\CountryObserver;

/**
 * Class Country.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class Country extends Model
{
    
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     *  Here we have the fulltext fields. We can use these for fulltext search if enabled.
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
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
		'id_ref'         => 'string',
		'code'           => 'string',
		'locale'         => 'string',
		'name'           => 'string',
		'currency_code'  => 'string',
		'phone_code'     => 'string',
		'rate'           => 'double',
		'percentage'     => 'double',
		'continent_name' => 'string',
		'continent_code' => 'string',
		'geo_name_id'    => 'integer',
		'is_active'      => 'boolean',
    ];

    /**
     * We are casting data fields.
     * @var array
     */
    protected $dates = [
        
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
        parent::observe(CountryObserver::class);
    }
}
