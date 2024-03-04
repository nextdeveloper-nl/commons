<?php

namespace NextDeveloper\Commons\Http\Controllers\Media;

use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Requests\Media\FileUploadCreateRequest;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Services\MediaService;
use Publitio\BadJSONResponse;

class FileUploadController extends AbstractController
{
    /**
     * This method created a Media object on a database.
     *
     * @param FileUploadCreateRequest $request
     * @return mixed|null
     * @throws BadJSONResponse
     */
    public function upload(FileUploadCreateRequest $request)
    {
        $model = MediaService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }
}
