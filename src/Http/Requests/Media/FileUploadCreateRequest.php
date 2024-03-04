<?php

namespace NextDeveloper\Commons\Http\Requests\Media;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class FileUploadCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
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
