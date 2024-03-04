<?php

namespace NextDeveloper\Commons\Http\Controllers\Media;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\Media\MediaUpdateRequest;
use NextDeveloper\Commons\Database\Filters\MediaQueryFilter;
use NextDeveloper\Commons\Services\MediaService;
use NextDeveloper\Commons\Http\Requests\Media\MediaCreateRequest;

class FileUploadController extends AbstractController
{
    /**
     * This method created Media object on database.
     *
     * @param  MediaCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function upload(MediaCreateRequest $request)
    {
        $model = MediaService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }
}
