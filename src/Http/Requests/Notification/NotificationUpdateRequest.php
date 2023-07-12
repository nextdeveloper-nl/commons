<?php

namespace NextDeveloper\Commons\Http\Requests\Notification;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class NotificationUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'type'            => 'nullable',
			'notifiable_id'   => 'nullable|exists:notifiables,uuid|uuid',
			'notifiable_type' => 'nullable|string|max:255',
			'data'            => 'nullable|string',
			'read_at'         => 'nullable|date',
			'user_id'         => 'nullable|exists:users,uuid|uuid',
			'account_id'      => 'nullable|exists:accounts,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}