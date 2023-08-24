<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\CommonRegistryObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
* Class CommonRegistry.
*
* @package NextDeveloper\Commons\Database\Models
*/
class CommonRegistry extends Model
{
use Filterable, UuidId;


	public $timestamps = false;

protected $table = 'common_registries';


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
'key'   => 'string',
		'value' => 'string',
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
parent::observe(CommonRegistryObserver::class);

self::registerScopes();
}

public static function registerScopes()
{
$globalScopes = config('commons.scopes.global');
$modelScopes = config('commons.scopes.common_registries');

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

// EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}