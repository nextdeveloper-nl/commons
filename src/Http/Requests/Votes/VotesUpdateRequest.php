<?php

namespace NextDeveloper\Commons\Http\Requests\Votes;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class VotesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'value'       => 'nullable|boolean',
        'object_id'   => 'nullable',
        'object_type' => 'nullable|string|max:500',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}