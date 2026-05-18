<?php

namespace NextDeveloper\Commons\Pushers\Drivers;

use Illuminate\Support\Facades\Http;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Pushers\AbstractPusher;
use NextDeveloper\Commons\Pushers\PusherResult;

/**
 * n8n pusher driver.
 *
 * Sends the PusherLog body as a JSON payload to an n8n webhook URL.
 * Uses acceptJson() and supports custom auth headers for n8n's
 * Header Auth credential type.
 *
 * Auth resolution order (when require_auth is true):
 *   1. Custom header:  auth_header => token
 *   2. Bearer token:   Authorization: Bearer <token>
 *
 * provider_metadata keys (all optional):
 *   timeout  int  Request timeout in seconds (default 30)
 */
class N8NPusher extends AbstractPusher
{
    public static function provider(): string
    {
        return 'n8n';
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
