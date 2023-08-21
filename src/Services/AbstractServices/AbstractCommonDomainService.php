<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Database\Models\CommonDomain;
use NextDeveloper\Commons\Database\Filters\CommonDomainQueryFilter;

use NextDeveloper\Commons\Events\CommonDomain\CommonDomainCreatedEvent;
use NextDeveloper\Commons\Events\CommonDomain\CommonDomainCreatingEvent;
use NextDeveloper\Commons\Events\CommonDomain\CommonDomainUpdatedEvent;
use NextDeveloper\Commons\Events\CommonDomain\CommonDomainUpdatingEvent;
use NextDeveloper\Commons\Events\CommonDomain\CommonDomainDeletedEvent;
use NextDeveloper\Commons\Events\CommonDomain\CommonDomainDeletingEvent;

/**
 * This class is responsible from managing the data for CommonDomain
 *
 * Class CommonDomainService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class AbstractCommonDomainService
{
    public static function get(CommonDomainQueryFilter $filter = null, array $params = []): Collection|LengthAwarePaginator
    {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
         * Here we are adding null request since if filter is null, this means that this function is called from
         * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
         *
         * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
         */
        if ($filter == null)
            $filter = new CommonDomainQueryFilter(new Request());

        $perPage = config('commons.pagination.per_page');

        if ($perPage == null)
            $perPage = 20;

        if (array_key_exists('per_page', $params)) {
            $perPage = intval($params['per_page']);

            if ($perPage == 0)
                $perPage = 20;
        }

        if (array_key_exists('orderBy', $params)) {
            $filter->orderBy($params['orderBy']);
        }

        $model = CommonDomain::filter($filter);

        if ($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll()
    {
        return CommonDomain::all();
    }

    /**
     * This method returns the model by looking at reference id
     *
     * @param $ref
     * @return mixed
     */
    public static function getByRef($ref): ?CommonDomain
    {
        return CommonDomain::findByRef($ref);
    }

    /**
     * This method returns the model by lookint at its id
     *
     * @param $id
     * @return CommonDomain|null
     */
    public static function getById($id): ?CommonDomain
    {
        return CommonDomain::where('id', $id)->first();
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
    public static function create(array $data)
    {
        event(new CommonDomainCreatingEvent());

        if (array_key_exists('iam_account_id', $data)) {
            $isUuid = Str::isUuid($data['iam_account_id']);

            if ($isUuid) {
                $obj = \NextDeveloper\IAM\Database\Models\IamAccount::findByUuid($data['iam_account_id']);
                $data['iam_account_id'] = $obj->id;
            }
        }

        if (array_key_exists('iam_user_id', $data)) {
            $isUuid = Str::isUuid($data['iam_user_id']);

            if ($isUuid) {
                $obj = \NextDeveloper\IAM\Database\Models\IamUser::findByUuid($data['iam_user_id']);
                $data['iam_user_id'] = $obj->id;
            }
        }

        try {
            $model = CommonDomain::create($data);
        } catch (\Exception $e) {
            throw $e;
        }

        event(new CommonDomainCreatedEvent($model));

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
    public static function update($id, array $data)
    {
        $model = CommonDomain::where('uuid', $id)->first();

        event(new CommonDomainsUpdateingEvent($model));

        try {
            $model = $model->update($data);
        } catch (\Exception $e) {
            throw $e;
        }

        event(new CommonDomainsUpdatedEvent($model));

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
    public static function delete($id, array $data)
    {
        $model = CommonDomain::where('uuid', $id)->first();

        event(new CommonDomainsDeletingEvent());

        try {
            $model = $model->delete();
        } catch (\Exception $e) {
            throw $e;
        }

        event(new CommonDomainsDeletedEvent($model));

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
