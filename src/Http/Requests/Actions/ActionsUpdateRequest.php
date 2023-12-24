<?php

namespace NextDeveloper\Commons\Http\Requests\Actions;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ActionsUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'action'   => 'nullable|string|max:500',
        'progress' => 'nullable|integer',
        'log'      => 'nullable|string',
        'error'    => 'nullable|string',
        'runtime'  => 'nullable|integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}