<?php

namespace NextDeveloper\Commons\Pushers\Drivers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Pushers\AbstractPusher;
use NextDeveloper\Commons\Pushers\PusherResult;

class LeadGenPusher extends AbstractPusher
{
    public static function provider(): string
    {
        return 'leadgen';
    }

    public function send(PusherLogs $log, Pushers $pusher): PusherResult
    {
        $body = $this->decodeBody($log);
        $metadata = $pusher->provider_metadata ?? [];
        $baseUrl = rtrim($pusher->url, '/');

        $request = Http::timeout(30);

        if ($pusher->auth_header) {
            $request = $request->withHeaders([$pusher->auth_header => $pusher->token]);
        } else {
            $request = $request->withToken($pusher->token);
        }

        $customerResponse = $request->post($baseUrl . '/customers', [
            'name' => $body['name'] ?? null,
            'email' => self::extractFirstFromPgArray($body['public_emails'] ?? null) ?? $body['email'] ?? null,
            'phone' => self::extractFirstFromPgArray($body['public_phone_numbers'] ?? null) ?? $body['phone'] ?? null,
        ]);

        if (!$customerResponse->successful()) {
            Log::error('[LeadGenPusher] Customer creation failed', [
                'pusher_log_id' => $log->id,
                'response_code' => $customerResponse->status(),
                'response_body' => $customerResponse->body(),
            ]);

            return PusherResult::fail($customerResponse->status(), $customerResponse->body());
        }

        $customerId = $customerResponse->json('data.customerId');

        $dealResponse = $request->post($baseUrl . '/deals', [
            'customerId' => $customerId,
            'name' => $body['deal_name'] ?? '',
            'title' => $body['deal_title'] ?? '',
            'boardId' => $metadata['boardId'] ?? null,
            'columnId' => $metadata['columnId'] ?? null,
        ]);

        return new PusherResult(
            $dealResponse->successful(),
            $dealResponse->status(),
            $dealResponse->body(),
        );
    }

    private static function extractFirstFromPgArray(string|array|null $value): ?string
    {
        if (!$value) {
            return null;
        }

        if (is_array($value)) {
            return $value[0] !== '' ? ($value[0] ?? null) : null;
        }

        $value = trim($value, '{}');
        $parts = str_getcsv($value, ',', '"');

        return $parts[0] !== '' ? $parts[0] : null;
    }
}
