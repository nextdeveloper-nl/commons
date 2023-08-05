<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\CommonCreditCardObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * Class CommonCreditCard.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class CommonCreditCard extends Model
{
    use Filterable, UuidId;
    use SoftDeletes;


    public $timestamps = true;

    protected $table = 'common_credit_cards';


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
        'id' => 'integer',
        'uuid' => 'string',
        'type' => 'string',
        'cc_holder_name' => 'string',
        'cc_number' => 'string',
        'cc_month' => 'string',
        'cc_year' => 'string',
        'cc_cvv' => 'string',
        'is_default' => 'boolean',
        'is_valid' => 'boolean',
        'is_active' => 'boolean',
        'score' => 'boolean',
        'is_3d_secure_enabled' => 'boolean',
        'retry_count' => 'boolean',
        'account_id' => 'integer',
        'user_id' => 'integer',
        'last_retry_date' => 'datetime',
        'verification_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * We are casting data fields.
     * @var array
     */
    protected $dates = [
        'last_retry_date',
        'verification_date',
        'created_at',
        'updated_at',
        'deleted_at',
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
        parent::observe(CommonCreditCardObserver::class);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}