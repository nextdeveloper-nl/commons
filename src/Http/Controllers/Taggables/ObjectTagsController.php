<?php

namespace NextDeveloper\Commons\Http\Controllers\Taggables;

use Illuminate\Http\Client\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Requests\Taggables\CreateTaggablesWithTagRequest;
use NextDeveloper\Commons\Services\TagsService;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Services\TaggablesService;
use NextDeveloper\Commons\Http\Requests\Taggables\TaggablesCreateRequest;

class ObjectTagsController extends AbstractController
{
    public function index() {
        dd('asd');
        $objectType = request()->get('object_type');
        $objectId = request()->get('object_id');

        $viewTags = TagsService::getTags($objectType, $objectId);

        return ResponsableFactory::makeResponse($this, $viewTags);
    }

    /**
    * This method created Taggables object on database.
    *
    * @param TaggablesCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CreateTaggablesWithTagRequest $request) {
        $model = TaggablesService::createWithTag($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }
}
