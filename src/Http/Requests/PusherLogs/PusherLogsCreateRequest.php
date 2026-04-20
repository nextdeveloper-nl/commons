<?php

namespace NextDeveloper\Commons\Http\Requests\PusherLogs;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class PusherLogsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'common_pusher_id' => 'required|exists:common_pushers,uuid|uuid',
        'status' => 'string',
        'object_id' => 'nullable',
        'object_type' => 'nullable|string',
        'body' => 'nullable',
        'response_code' => 'nullable|integer',
        'response_body' => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}