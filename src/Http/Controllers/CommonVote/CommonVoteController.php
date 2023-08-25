<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonVote;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonVote\CommonVoteUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonVoteQueryFilter;
use NextDeveloper\Commons\Services\CommonVoteService;
use NextDeveloper\Commons\Http\Requests\CommonVote\CommonVoteCreateRequest;

class CommonVoteController extends AbstractController
{
    /**
    * This method returns the list of commonvotes.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonVoteQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonVoteQueryFilter $filter, Request $request) {
        $data = CommonVoteService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonVoteId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonVoteService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonVote object on database.
    *
    * @param CommonVoteCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonVoteCreateRequest $request) {
        $model = CommonVoteService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonVote object on database.
    *
    * @param $commonVoteId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonVoteId, CommonVoteUpdateRequest $request) {
        $model = CommonVoteService::update($commonVoteId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonVote object on database.
    *
    * @param $commonVoteId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonVoteId) {
        $model = CommonVoteService::delete($commonVoteId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}