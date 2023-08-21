<?php

namespace NextDeveloper\Commons\Http\Requests\Remindable;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class RemindableCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'remindable_id'          => 'required|exists:remindables,uuid|uuid',
			'remindable_object_type' => 'required|string|max:191',
			'remind_datetime'        => 'nullable|date',
			'snooze_datetime'        => 'nullable|date',
			'iam_user_id'                => 'nullable|exists:users,uuid|uuid',
			'note'                   => 'nullable|string',
			'status'                 => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}