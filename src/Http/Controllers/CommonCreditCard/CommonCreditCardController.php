<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonCreditCard;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonCreditCard\CommonCreditCardUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonCreditCardQueryFilter;
use NextDeveloper\Commons\Services\CommonCreditCardService;
use NextDeveloper\Commons\Http\Requests\CommonCreditCard\CommonCreditCardCreateRequest;

class CommonCreditCardController extends AbstractController
{
    /**
    * This method returns the list of commoncreditcards.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonCreditCardQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonCreditCardQueryFilter $filter, Request $request) {
        $data = CommonCreditCardService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonCreditCardId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonCreditCardService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonCreditCard object on database.
    *
    * @param CommonCreditCardCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonCreditCardCreateRequest $request) {
        $model = CommonCreditCardService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonCreditCard object on database.
    *
    * @param $commonCreditCardId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonCreditCardId, CommonCreditCardUpdateRequest $request) {
        $model = CommonCreditCardService::update($commonCreditCardId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonCreditCard object on database.
    *
    * @param $commonCreditCardId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonCreditCardId) {
        $model = CommonCreditCardService::delete($commonCreditCardId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}