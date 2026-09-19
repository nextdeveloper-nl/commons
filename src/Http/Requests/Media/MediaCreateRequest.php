<?php

namespace NextDeveloper\Commons\Http\Requests\Media;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class MediaCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'object_id' => 'nullable|uuid|required_with:object_type',
        'object_type' => 'nullable|string',
        'collection_name' => 'nullable|string',
        'name' => 'nullable|string',
        'cdn_url' => 'required|url',
        'file_name' => 'nullable|string',
        'mime_type' => 'nullable|string',
        'disk' => 'nullable|string',
        'size' => 'nullable|integer',
        'manipulations' => 'nullable',
        'custom_properties' => 'nullable',
        'order_column' => 'nullable|integer',
        'tags' => '',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n



}