<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Services\AbstractServices\AbstractPusherLogsService;

/**
 * This class is responsible from managing the data for PusherLogs
 *
 * Class PusherLogsService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class PusherLogsService extends AbstractPusherLogsService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    public static function create(array $data): PusherLogs
    {
        if (!array_key_exists('status', $data) || empty($data['status'])) {
            $data['status'] = 'pending';
        }

        $objectType = $data['object_type'] ?? null;
        $objectId = $data['object_id'] ?? null;

        if ($objectType && $objectId) {
            $path = Str::beforeLast($objectType, '\\');
            $className = Str::afterLast($objectType, '\\');
            $class = "$path\\Database\\Models\\$className";

            if (class_exists($class)) {
                $object = Str::isUuid($objectId)
                    ? $class::where('uuid', $objectId)->first()
                    : $class::where('id', $objectId)->first();

                if ($object) {
                    $perspectivePath = $class . 'Perspective';

                    if (class_exists($perspectivePath)) {
                        $perspective = $perspectivePath::where('id', $object->id)->first();
                        $objectBody = $perspective ? $perspective->toArray() : $object->toArray();
                    } else {
                        $objectBody = $object->toArray();
                    }

                    $existingBody = $data['body'] ?? [];

                    if (is_string($existingBody)) {
                        $existingBody = json_decode($existingBody, true) ?? [];
                    }

                    $data['body'] = array_merge($objectBody, $existingBody);
                    $data['object_id'] = $object->id;
                }
            }
        }

        return parent::create($data);
    }
}
