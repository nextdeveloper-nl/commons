<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Services\AbstractServices\AbstractPusherLogsService;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;
use NextDeveloper\IAM\Helpers\UserHelper;

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
                        $data['body'] = $perspective ? $perspective->toArray() : $object->toArray();
                    } else {
                        $data['body'] = $object->toArray();
                    }

                    $data['object_id'] = $object->id;
                }
            }
        }

        return parent::create($data);
    }

    public static function push(PusherLogs $pusherLog): void
    {
        UserHelper::runAsAdmin(function () use ($pusherLog) {

            $pusher = Pushers::withoutGlobalScope(AuthorizationScope::class)
                ->where('id', $pusherLog->common_pusher_id)
                ->first();

            if (!$pusher) {
                Log::warning('[PusherLogsService] Pushers not found', [
                    'pusher_log_id' => $pusherLog->id,
                    'common_pusher_id' => $pusherLog->common_pusher_id,
                ]);

                $pusherLog->update(['status' => 'failed']);

                return;
            }

            try {
                $request = Http::timeout(30);

                if ($pusher->require_auth) {
                    $request = $request->withToken($pusher->token);
                }

                $method = strtolower($pusher->method ?? 'post');
                $body = $pusherLog->body;

                if (is_string($body)) {
                    $body = json_decode($body, true) ?? [];
                }

                $response = $request->$method($pusher->url, $body ?? []);

                $pusherLog->update([
                    'response_code' => $response->status(),
                    'response_body' => $response->body(),
                    'status' => $response->successful() ? 'completed' : 'failed',
                ]);

                Log::info('[PusherLogsService] Push executed', [
                    'pusher_log_id' => $pusherLog->id,
                    'url' => $pusher->url,
                    'response_code' => $response->status(),
                ]);
            } catch (\Throwable $e) {
                Log::error('[PusherLogsService] Failed to push object', [
                    'pusher_log_id' => $pusherLog->id,
                    'url' => $pusher->url ?? null,
                    'error' => $e->getMessage(),
                ]);

                $pusherLog->update([
                    'status' => 'failed',
                    'response_body' => $e->getMessage(),
                ]);

                throw $e;
            }
        });
    }
}
