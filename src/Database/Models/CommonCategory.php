<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\CommonCategoryObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
* Class CommonCategory.
*
* @package NextDeveloper\Commons\Database\Models
*/
class CommonCategory extends Model
{
use Filterable, UuidId;
	use SoftDeletes;


	public $timestamps = true;

protected $table = 'common_categories';


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
'id'                          => 'integer',
		'uuid'                        => 'string',
		'slug'                        => 'string',
		'name'                        => 'string',
		'description'                 => 'string',
		'url'                         => 'string',
		'is_active'                   => 'boolean',
		'common_domain_id'            => 'integer',
		'common_categories_parent_id' => 'integer',
		'_lft'                        => 'integer',
		'_rgt'                        => 'integer',
		'order'                       => 'integer',
		'created_at'                  => 'datetime',
		'updated_at'                  => 'datetime',
		'deleted_at'                  => 'datetime',
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
parent::observe(CommonCategoryObserver::class);

self::registerScopes();
}

public static function registerScopes()
{
$globalScopes = config('commons.scopes.global');
$modelScopes = config('commons.scopes.common_categories');

if(!$modelScopes) $modelScopes = [];
if (!$globalScopes) $globalScopes = [];

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

public function commonDomain()
    {
        return $this->belongsTo(CommonDomain::class);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n
}