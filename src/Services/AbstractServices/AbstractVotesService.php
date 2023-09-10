<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\Votes;
use NextDeveloper\Commons\Database\Filters\VotesQueryFilter;
use NextDeveloper\Commons\Events\Votes\VotesCreatedEvent;
use NextDeveloper\Commons\Events\Votes\VotesCreatingEvent;
use NextDeveloper\Commons\Events\Votes\VotesUpdatedEvent;
use NextDeveloper\Commons\Events\Votes\VotesUpdatingEvent;
use NextDeveloper\Commons\Events\Votes\VotesDeletedEvent;
use NextDeveloper\Commons\Events\Votes\VotesDeletingEvent;


/**
* This class is responsible from managing the data for Votes
*
* Class VotesService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractVotesService {
    public static function get(VotesQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new VotesQueryFilter(new Request());

        $perPage = config('commons.pagination.per_page');

        if($perPage == null)
            $perPage = 20;

        if(array_key_exists('per_page', $params)) {
            $perPage = intval($params['per_page']);

            if($perPage == 0)
                $perPage = 20;
        }

        if(array_key_exists('orderBy', $params)) {
            $filter->orderBy($params['orderBy']);
        }

        $model = Votes::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return Votes::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?Votes {
        return Votes::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return Votes|null
    */
    public static function getById($id) : ?Votes {
        return Votes::where('id', $id)->first();
    }

    /**
    * This method created the model from an array.
    *
    * Throws an exception if stuck with any problem.
    *
    * @param array $data
    * @return mixed
    * @throw Exception
    */
    public static function create(array $data) {
        event( new VoteCreatingEvent() );

                if (array_key_exists('voteable_id', $data))
            $data['voteable_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Voteable',
                $data['voteable_id']
            );
	        if (array_key_exists('iam_user_id', $data))
            $data['iam_user_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\IAM\Database\Models\IamUser',
                $data['iam_user_id']
            );
	        
        try {
            $model = Votes::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new VotesCreatedEvent($model) );

        return $model->fresh();
    }

/**
* This function expects the ID inside the object.
*
* @param array $data
* @return Votes
*/
public static function updateRaw(array $data) : ?Votes
{
if(array_key_exists('id', $data)) {
return self::update($data['id'], $data);
}

return null;
}

    /**
    * This method updated the model from an array.
    *
    * Throws an exception if stuck with any problem.
    *
    * @param
    * @param array $data
    * @return mixed
    * @throw Exception
    */
    public static function update($id, array $data) {
        $model = Votes::where('uuid', $id)->first();

                if (array_key_exists('voteable_id', $data))
            $data['voteable_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Voteable',
                $data['voteable_id']
            );
	        if (array_key_exists('iam_user_id', $data))
            $data['iam_user_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\IAM\Database\Models\IamUser',
                $data['iam_user_id']
            );
	
        event( new VotesUpdatingEvent($model) );

        try {
           $isUpdated = $model->update($data);
           $model = $model->fresh();
        } catch(\Exception $e) {
           throw $e;
        }

        event( new VotesUpdatedEvent($model) );

        return $model->fresh();
    }

    /**
    * This method updated the model from an array.
    *
    * Throws an exception if stuck with any problem.
    *
    * @param
    * @param array $data
    * @return mixed
    * @throw Exception
    */
    public static function delete($id, array $data) {
        $model = Votes::where('uuid', $id)->first();

        event( new VotesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new VotesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
