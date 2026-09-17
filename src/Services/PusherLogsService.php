<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Exceptions\NotAllowedException;
use NextDeveloper\Commons\Exceptions\NotFoundException;
use NextDeveloper\Commons\Jobs\PusherLogs\PushObjectJob;
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

    /**
     * Re-queues a push log ("pending" stuck or "failed") for delivery.
     *
     * @throws NotFoundException
     * @throws NotAllowedException
     */
    public static function retry($ref): PusherLogs
    {
        $log = Str::isUuid($ref)
            ? PusherLogs::withoutGlobalScopes()->where('uuid', $ref)->first()
            : PusherLogs::withoutGlobalScopes()->where('id', $ref)->first();

        if (!$log) {
            throw new NotFoundException('Cannot find the pusher log you are trying to retry.');
        }

        if ($log->status === 'completed') {
            throw new NotAllowedException('This push already completed successfully, there is nothing to retry.');
        }

        $log->update([
            'status' => 'pending',
            'retry_count' => $log->retry_count + 1,
        ]);

        PushObjectJob::dispatch($log)->onQueue('pushers');

        return $log->fresh();
    }
}
