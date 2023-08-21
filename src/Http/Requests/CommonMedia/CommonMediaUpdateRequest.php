<?php

namespace NextDeveloper\Commons\Http\Requests\CommonMedia;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonMediaUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'mediable_id'       => 'nullable|exists:mediables,uuid|uuid',
			'mediable_type'     => 'nullable|string|max:500',
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
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n
}