<?php

namespace NextDeveloper\Commons\Http\Requests\TaskSchedulers;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class TaskSchedulersCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'day_of_month' => 'nullable|integer',
            'day_of_week' => 'nullable|integer',
            'time_of_day' => 'nullable',
            'schedule_type' => 'string',
            'next_run' => 'nullable|date',
            'object_type' => 'nullable|string',
            'object_id' => 'nullable',
            'common_available_action_id' => 'nullable|exists:common_available_actions,uuid|uuid',
            'params' => 'nullable',
            'timezone' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE


}
