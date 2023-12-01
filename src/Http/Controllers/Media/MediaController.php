<?php

namespace NextDeveloper\Commons\Http\Controllers\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\Media\MediaUpdateRequest;
use NextDeveloper\Commons\Database\Filters\MediaQueryFilter;
use NextDeveloper\Commons\Services\MediaService;
use NextDeveloper\Commons\Http\Requests\Media\MediaCreateRequest;

class MediaController extends AbstractController
{
    /**
    * This method returns the list of media.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param MediaQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(MediaQueryFilter $filter, Request $request) {
        $data = MediaService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $mediaId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = MediaService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created Media object on database.
    *
    * @param MediaCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(MediaCreateRequest $request) {
        $data       = $request->validated();
        $file       = $request->file('file');
        $fileName   = $file->getClientOriginalName();
        $directory  = storage_path('temporary');

        // Create temporary folder, if not exist
        if (!File::isDirectory($directory))
        {
            File::makeDirectory($directory, 0775, false, false);
        }

        $uploadToLocalStore = $file->store('temporary');
        $data['file']       = storage_path('app/' . $uploadToLocalStore);
        $data['file_name']  = $fileName;

        $model = MediaService::create($data);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates Media object on database.
    *
    * @param $mediaId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($mediaId, MediaUpdateRequest $request) {
        $model = MediaService::update($mediaId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates Media object on database.
    *
    * @param $mediaId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($mediaId) {
        $model = MediaService::delete($mediaId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}