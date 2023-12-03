<?php

namespace NextDeveloper\Commons\Http\Requests\Media;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class MediaUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'object_id'         => 'nullable|string|max:36',
        'object_type'       => 'nullable|string|max:500',
        'collection_name'   => 'nullable|string|max:255',
        'name'              => 'nullable|string|max:255',
        'cdn_url'           => 'nullable|string|max:255',
        'file_name'         => 'nullable|string|max:255',
        'mime_type'         => 'nullable|string|max:255',
        'disk'              => 'nullable|string|max:255',
        'size'              => 'nullable|integer',
        'manipulations'     => 'nullable|string',
        'custom_properties' => 'nullable|string',
        'order_column'      => 'nullable|integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}