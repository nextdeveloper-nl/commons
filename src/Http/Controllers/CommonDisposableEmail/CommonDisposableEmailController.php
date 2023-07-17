<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonDisposableEmail;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonDisposableEmail\CommonDisposableEmailUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonDisposableEmailQueryFilter;
use NextDeveloper\Commons\Services\CommonDisposableEmailService;
use NextDeveloper\Commons\Http\Requests\CommonDisposableEmail\CommonDisposableEmailCreateRequest;

class CommonDisposableEmailController extends AbstractController
{
    /**
    * This method returns the list of commondisposableemails.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonDisposableEmailQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonDisposableEmailQueryFilter $filter, Request $request) {
        $data = CommonDisposableEmailService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonDisposableEmailId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonDisposableEmailService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonDisposableEmail object on database.
    *
    * @param CommonDisposableEmailCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonDisposableEmailCreateRequest $request) {
        $model = CommonDisposableEmailService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonDisposableEmail object on database.
    *
    * @param $commonDisposableEmailId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonDisposableEmailId, CommonDisposableEmailUpdateRequest $request) {
        $model = CommonDisposableEmailService::update($commonDisposableEmailId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonDisposableEmail object on database.
    *
    * @param $commonDisposableEmailId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonDisposableEmailId) {
        $model = CommonDisposableEmailService::delete($commonDisposableEmailId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}