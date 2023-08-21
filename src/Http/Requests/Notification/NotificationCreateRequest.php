<?php

namespace NextDeveloper\Commons\Http\Requests\Notification;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class NotificationCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'type'            => 'required',
			'notifiable_id'   => 'required|exists:notifiables,uuid|uuid',
			'notifiable_type' => 'required|string|max:255',
			'data'            => 'required|string',
			'read_at'         => 'nullable|date',
			'iam_user_id'         => 'required|exists:users,uuid|uuid',
			'iam_account_id'      => 'required|exists:accounts,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}