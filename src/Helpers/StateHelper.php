<?php

namespace NextDeveloper\Commons\Helpers;

use NextDeveloper\Commons\Database\Models\States;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;

class StateHelper
{
    public const STATE_INFO = 'info';

    public const STATE_WARNING = 'warning';

    public const STATE_ERROR = 'error';

    public const STATE_SUCCESS = 'success';

    public const STATE_DANGER = 'danger';

    public const STATE_FATAL = 'fatal';

    public static function setState($obj, $stateName, $value, $objectState = null, $reason = null)
    {
        $state = self::getState($obj, $stateName);

        switch ($objectState) {
            case 'warning':
                $objectState = 'warn';
                break;
        }

        if($state) {
            $state->update([
                'value' => $value,
                'object_states' => $objectState ?? 'info',
                'reason' => $reason ?? ''
            ]);

            return $state->fresh();
        }

        return States::create([
            'object_type' => get_class($obj),
            'object_id' => $obj->id,
            'name' => $stateName,
            'value' => $value,
            'object_states' => $objectState ?? 'info',
            'reason' => $reason ?? ''
        ]);
    }

    public static function getState($obj, $stateName)
    {
        return States::withoutGlobalScope(AuthorizationScope::class)
            ->where('object_type', get_class($obj))
            ->where('object_id', $obj->id)
            ->where('name', $stateName)
            ->first();
    }

    public static function deleteState($obj, $stateName): void
    {
        $state = self::getState($obj, $stateName);

        if($state) {
            $state->delete();
        }
    }

    public static function clearStates($obj): void
    {
        States::withoutGlobalScope(AuthorizationScope::class)
            ->where('object_type', get_class($obj))
            ->where('object_id', $obj->id)
            ->delete();
    }

    public static function setRunningActions($obj, $action, $checkpoint = null)
    {
        $runningActions = self::getState($obj, 'running_actions');

        $value = $runningActions ? json_decode($runningActions->value, true) : [];

        if($runningActions) {
            $value[$action->action] = [
                'checkpoint' => $checkpoint,
                'id'    =>  $action->id,
            ];

            $runningActions->update([
                'value' => json_encode($value)
            ]);

            return $runningActions->fresh();
        } else {
            self::setState($obj, 'running_actions', json_encode([
                $action->action => [
                    'checkpoint' => $checkpoint,
                    'id'    =>  $action->id,
                ]
            ]), 'info', 'Running actions updated');
        }
    }

    public static function removeRunningAction($obj, $action)
    {
        $runningActions = self::getState($obj, 'running_actions');

        $runningAction = json_decode($runningActions->value, true);

        if($runningAction) {
            unset($runningAction[$action->action]);

            $runningActions->update([
                'value' => json_encode($runningAction)
            ]);
        }
    }
}
