<?php

namespace NextDeveloper\Commons\Database\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Traits\Filterable;
use NextDeveloper\Commons\Database\Observers\CommonCommentObserver;
use NextDeveloper\Commons\Database\Traits\UuidId;

/**
* Class CommonComment.
*
* @package NextDeveloper\Commons\Database\Models
*/
class CommonComment extends Model
{
use Filterable, UuidId;
	use SoftDeletes;


	public $timestamps = true;

protected $table = 'common_comments';


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
		'body'             => 'string',
		'iam_user_id'      => 'integer',
		'commentable_id'   => 'integer',
		'commentable_type' => 'string',
		'_lft'             => 'integer',
		'_rgt'             => 'integer',
		'parent_id'        => 'integer',
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
parent::observe(CommonCommentObserver::class);

self::registerScopes();
}

public static function registerScopes()
{
$globalScopes = config('commons.scopes.global');
$modelScopes = config('commons.scopes.common_comments');

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

// EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n
}