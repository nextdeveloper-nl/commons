<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonComment;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonComment\CommonCommentUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonCommentQueryFilter;
use NextDeveloper\Commons\Services\CommonCommentService;
use NextDeveloper\Commons\Http\Requests\CommonComment\CommonCommentCreateRequest;

class CommonCommentController extends AbstractController
{
    /**
    * This method returns the list of commoncomments.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonCommentQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonCommentQueryFilter $filter, Request $request) {
        $data = CommonCommentService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonCommentId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonCommentService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonComment object on database.
    *
    * @param CommonCommentCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonCommentCreateRequest $request) {
        $model = CommonCommentService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonComment object on database.
    *
    * @param $commonCommentId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonCommentId, CommonCommentUpdateRequest $request) {
        $model = CommonCommentService::update($commonCommentId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonComment object on database.
    *
    * @param $commonCommentId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonCommentId) {
        $model = CommonCommentService::delete($commonCommentId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}