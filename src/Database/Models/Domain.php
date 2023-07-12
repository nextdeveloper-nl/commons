<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\DomainObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
 * Class Domain.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class Domain extends Model
{
    use Filterable, UuidId;
    use SoftDeletes;
    

    public $timestamps = true;

    protected $table = 'domains';


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
        'id'               => 'integer',
		'uuid'             => 'string',
		'account_id'       => 'integer',
		'name'             => 'string',
		'is_active'        => 'boolean',
		'is_local_domain'  => 'boolean',
		'is_locked'        => 'boolean',
		'is_shared_domain' => 'boolean',
		'created_at'       => 'datetime',
		'updated_at'       => 'datetime',
		'deleted_at'       => 'datetime',
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
        parent::observe(DomainObserver::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}