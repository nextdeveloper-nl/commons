<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\ExchangeRateObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * Class ExchangeRate.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class ExchangeRate extends Model
{
    use Filterable, UuidId;
    

    public $timestamps = true;

    protected $table = 'exchange_rates';


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
        'id'            => 'integer',
		'uuid'          => 'string',
		'country_id'    => 'integer',
		'rate'          => 'double',
		'last_modified' => 'datetime',
		'created_at'    => 'datetime',
		'updated_at'    => 'datetime',
    ];

    /**
     * We are casting data fields.
     * @var array
     */
    protected $dates = [
        'last_modified',
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
        parent::observe(ExchangeRateObserver::class);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}