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
                    if ($pusher->auth_header) {
                        $request = $request->withHeaders([$pusher->auth_header => $pusher->token]);
                    } else {
                        $request = $request->withToken($pusher->token);
                    }
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

    public static function leadgenPush(PusherLogs $pusherLog): void
    {
        UserHelper::runAsAdmin(function () use ($pusherLog) {
            $pusher = Pushers::withoutGlobalScope(AuthorizationScope::class)
                ->where('id', $pusherLog->common_pusher_id)
                ->first();

            if (!$pusher) {
                Log::warning('[PusherLogsService] Pushers not found for leadgen', [
                    'pusher_log_id' => $pusherLog->id,
                    'common_pusher_id' => $pusherLog->common_pusher_id,
                ]);

                $pusherLog->update(['status' => 'failed']);

                return;
            }

            $body = $pusherLog->body;

            if (is_string($body)) {
                $body = json_decode($body, true) ?? [];
            }

            $metadata = $pusher->provider_metadata ?? [];

            $baseUrl = rtrim($pusher->url, '/');

            try {
                $request = Http::timeout(30);

                if ($pusher->auth_header) {
                    $request = $request->withHeaders([$pusher->auth_header => $pusher->token]);
                } else {
                    $request = $request->withToken($pusher->token);
                }

                // Step 1: Create customer
                $customerResponse = $request->post($baseUrl . '/customers', [
                    'name' => $body['name'] ?? null,
                    'email' => self::extractFirstFromPgArray($body['public_emails'] ?? null) ?? $body['email'] ?? null,
                    'phone' => self::extractFirstFromPgArray($body['public_phone_numbers'] ?? null) ?? $body['phone'] ?? null,
                ]);

                if (!$customerResponse->successful()) {
                    Log::error('[PusherLogsService] Leadgen customer creation failed', [
                        'pusher_log_id' => $pusherLog->id,
                        'response_code' => $customerResponse->status(),
                        'response_body' => $customerResponse->body(),
                    ]);

                    $pusherLog->update([
                        'status' => 'failed',
                        'response_code' => $customerResponse->status(),
                        'response_body' => $customerResponse->body(),
                    ]);

                    return;
                }

                $customerId = $customerResponse->json('data.customerId');

                Log::info('[PusherLogsService] Leadgen customer response', [
                    'pusher_log_id' => $pusherLog->id,
                    'response_code' => $customerResponse->status(),
                    'response_body' => $customerResponse->body(),
                    'customer_id' => $customerId,
                ]);

                // Step 2: Create deal
                $dealResponse = $request->post($baseUrl . '/deals', [
                    'customerId' => $customerId,
                    'name' => $body['deal_name'] ?? '',
                    'title' => $body['deal_title'] ?? '',
                    'boardId' => $metadata['boardId'] ?? null,
                    'columnId' => $metadata['columnId'] ?? null,
                ]);

                $pusherLog->update([
                    'response_code' => $dealResponse->status(),
                    'response_body' => $dealResponse->body(),
                    'status' => $dealResponse->successful() ? 'completed' : 'failed',
                ]);

                Log::info('[PusherLogsService] Leadgen push executed', [
                    'pusher_log_id' => $pusherLog->id,
                    'customer_id' => $customerId,
                    'deal_status' => $dealResponse->status(),
                ]);
            } catch (\Throwable $e) {
                Log::error('[PusherLogsService] Leadgen push failed', [
                    'pusher_log_id' => $pusherLog->id,
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

    private static function extractFirstFromPgArray(string|array|null $value): ?string
    {
        if (!$value) {
            return null;
        }

        if (is_array($value)) {
            return $value[0] !== '' ? ($value[0] ?? null) : null;
        }

        // Strip surrounding braces and split: {val1,val2} or {"val1","val2"}
        $value = trim($value, '{}');
        $parts = str_getcsv($value, ',', '"');

        return $parts[0] !== '' ? $parts[0] : null;
    }
}
