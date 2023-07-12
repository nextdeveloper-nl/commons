<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\LanguageObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * Class Language.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class Language extends Model
{
    use Filterable, UuidId;
    

    public $timestamps = false;

    protected $table = 'languages';


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
        'id'              => 'integer',
		'uuid'            => 'string',
		'iso_639_1_code'  => 'string',
		'iso_639_2_code'  => 'string',
		'iso_639_2b_code' => 'string',
		'code'            => 'string',
		'code_v2'         => 'string',
		'code_v2b'        => 'string',
		'name'            => 'string',
		'native_name'     => 'string',
		'is_default'      => 'boolean',
		'is_active'       => 'boolean',
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
        parent::observe(LanguageObserver::class);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}