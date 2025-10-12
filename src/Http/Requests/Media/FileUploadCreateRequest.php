<?php

namespace NextDeveloper\Commons\Http\Requests\Media;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class FileUploadCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['object_id' => "string", 'object_type' => "string", 'collection_name' => "string", 'name' => "string", 'tags' => "string", 'file' => "string"])]
    public function rules()
    {
        return [
            'object_id'         => 'nullable',
            'object_type'       => 'nullable|string',
            'collection_name'   => 'nullable|string',
            'name'              => 'nullable|string',
            'tags'              => '',
            'file'              => 'required|file',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n

}
