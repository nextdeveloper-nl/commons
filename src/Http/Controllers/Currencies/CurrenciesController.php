<?php

namespace NextDeveloper\Commons\Http\Controllers\Currencies;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CurrenciesQueryFilter;
use NextDeveloper\Commons\Database\Models\Currencies;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Requests\Currencies\CurrenciesCreateRequest;
use NextDeveloper\Commons\Http\Requests\Currencies\CurrenciesUpdateRequest;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Http\Traits\Addresses;
use NextDeveloper\Commons\Http\Traits\Tags;
use NextDeveloper\Commons\Services\CurrenciesService;

class CurrenciesController extends AbstractController
{
    private $model = Currencies::class;

    use Tags;
    use Addresses;
    /**
     * This method returns the list of currencies.
     *
     * optional http params:
     * - paginate: If you set paginate parameter, the result will be returned paginated.
     *
     * @param  CurrenciesQueryFilter $filter  An object that builds search query
     * @param  Request               $request Laravel request object, this holds all data about request. Automatically populated.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CurrenciesQueryFilter $filter, Request $request)
    {
        $data = CurrenciesService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
     * This function returns the list of actions that can be performed on this object.
     *
     * @return void
     */
    public function getActions()
    {
        $data = CurrenciesService::getActions();

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
     * Makes the related action to the object
     *
     * @param  $objectId
     * @param  $action
     * @return array
     */
    public function doAction($objectId, $action)
    {
        $actionId = CurrenciesService::doAction($objectId, $action, request()->all());

        return $this->withArray(
            [
            'action_id' =>  $actionId
            ]
        );
    }

    /**
     * This method receives ID for the related model and returns the item to the client.
     *
     * @param  $currenciesId
     * @return mixed|null
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function show($ref)
    {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CurrenciesService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method returns the list of sub objects the related object. Sub object means an object which is preowned by
     * this object.
     *
     * It can be tags, addresses, states etc.
     *
     * @param  $ref
     * @param  $subObject
     * @return void
     */
    public function relatedObjects($ref, $subObject)
    {
        $objects = CurrenciesService::relatedObjects($ref, $subObject);

        return ResponsableFactory::makeResponse($this, $objects);
    }

    /**
     * This method created Currencies object on database.
     *
     * @param  CurrenciesCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function store(CurrenciesCreateRequest $request)
    {
        if($request->has('validateOnly') && $request->get('validateOnly') == true) {
            return [
                'validation'    =>  'success'
            ];
        }

        $model = CurrenciesService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates Currencies object on database.
     *
     * @param  $currenciesId
     * @param  CurrenciesUpdateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function update($currenciesId, CurrenciesUpdateRequest $request)
    {
        if($request->has('validateOnly') && $request->get('validateOnly') == true) {
            return [
                'validation'    =>  'success'
            ];
        }

        $model = CurrenciesService::update($currenciesId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates Currencies object on database.
     *
     * @param  $currenciesId
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function destroy($currenciesId)
    {
        $model = CurrenciesService::delete($currenciesId);

        return $this->noContent();
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
