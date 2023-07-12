<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\TagObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * Class Tag.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class Tag extends Model
{
    use Filterable, UuidId;
    use SoftDeletes;
    

    public $timestamps = true;

    protected $table = 'tags';


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
        'id'          => 'integer',
		'uuid'        => 'string',
		'name'        => 'string',
		'description' => 'string',
		'slug'        => 'string',
		'user_id'     => 'integer',
		'account_id'  => 'integer',
		'created_at'  => 'datetime',
		'updated_at'  => 'datetime',
		'deleted_at'  => 'datetime',
    ];

    /**
     * We are casting data fields.
     * @var array
     */
    protected $dates = [
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
        parent::observe(TagObserver::class);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}