<?php

namespace NextDeveloper\Commons\Http\Requests\Remindable;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class RemindableUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'remindable_id'          => 'nullable|exists:remindables,uuid|uuid',
			'remindable_object_type' => 'nullable|string|max:191',
			'remind_datetime'        => 'nullable|date',
			'snooze_datetime'        => 'nullable|date',
			'iam_user_id'                => 'nullable|exists:users,uuid|uuid',
			'note'                   => 'nullable|string',
			'status'                 => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}