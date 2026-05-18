<?php

namespace NextDeveloper\Commons\Pushers\Drivers;

use Illuminate\Support\Facades\Http;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Pushers\AbstractPusher;
use NextDeveloper\Commons\Pushers\PusherResult;

/**
 * Generic webhook pusher.
 *
 * Sends the PusherLog body as a JSON payload to the URL configured on the
 * Pusher record. Designed for automation triggers where the calling code
 * builds the full payload before creating the PusherLog.
 *
 * Auth resolution order (when require_auth is true):
 *   1. Custom header:  auth_header => token
 *   2. Bearer token:   Authorization: Bearer <token>
 *
 * provider_metadata keys (all optional):
 *   timeout  int  Request timeout in seconds (default 30)
 */
class WebhookPusher extends AbstractPusher
{
    public static function provider(): string
    {
        return 'webhook';
    }

    public function send(PusherLogs $log, Pushers $pusher): PusherResult
    {
        $method  = strtolower($pusher->method ?? 'post');
        $timeout = (int) data_get($pusher->provider_metadata, 'timeout', 30);
        $body    = $this->decodeBody($log);

        $request = Http::acceptJson()->timeout($timeout);

        if ($pusher->require_auth && $pusher->token) {
            if ($pusher->auth_header) {
                $request = $request->withHeaders([$pusher->auth_header => $pusher->token]);
            } else {
                $request = $request->withToken($pusher->token);
            }
        }

        $response = $request->$method($pusher->url, $body);

        return new PusherResult(
            $response->successful(),
            $response->status(),
            $response->body(),
        );
    }
}
