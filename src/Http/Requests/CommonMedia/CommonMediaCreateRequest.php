<?php

namespace NextDeveloper\Commons\Http\Requests\CommonMedia;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonMediaCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'mediable_id'       => 'required|exists:mediables,uuid|uuid',
			'mediable_type'     => 'required|string|max:500',
			'collection_name'   => 'required|string|max:255',
			'name'              => 'required|string|max:255',
			'cdn_url'           => 'nullable|string|max:255',
			'file_name'         => 'required|string|max:255',
			'mime_type'         => 'nullable|string|max:255',
			'disk'              => 'required|string|max:255',
			'size'              => 'required|integer',
			'manipulations'     => 'required|string',
			'custom_properties' => 'required|string',
			'order_column'      => 'nullable|integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n
}