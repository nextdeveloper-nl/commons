<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\CategoryObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * Class Category.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class Category extends Model
{
    use Filterable, UuidId;
    use SoftDeletes;
    

    public $timestamps = true;

    protected $table = 'categories';


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
		'slug'        => 'string',
		'name'        => 'string',
		'description' => 'string',
		'url'         => 'string',
		'is_active'   => 'boolean',
		'domain_id'   => 'integer',
		'user_id'     => 'integer',
		'parent_id'   => 'integer',
		'_lft'        => 'integer',
		'_rgt'        => 'integer',
		'order'       => 'integer',
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
        parent::observe(CategoryObserver::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}