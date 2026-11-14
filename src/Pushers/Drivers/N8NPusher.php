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
 *   timeout   int   Request timeout in seconds (default 30)
 *   is_test   bool  Replace /webhook/ with /webhook-test/ in the URL
 */
class N8NPusher extends AbstractPusher
{
    public static function provider(): string
    {
        return 'n8n';
    }

    /**
     * Self-description used by GET /commons/pushers/providers.
     */
    public static function definition(): array
    {
        return array_merge(parent::definition(), [
            'label'           => 'n8n',
            'description'     => 'Sends the payload to an n8n webhook.',
            'is_internal'     => false,
            'requires_url'    => true,
            'requires_token'  => false,
            'supports_auth'   => true,
            'metadata_fields' => [
                ['key' => 'timeout', 'type' => 'integer', 'required' => false, 'label' => 'Timeout (seconds)', 'default' => 30],
                ['key' => 'is_test', 'type' => 'boolean', 'required' => false, 'label' => 'Use test webhook URL', 'default' => false],
            ],
        ]);
    }

    public function send(PusherLogs $log, Pushers $pusher): PusherResult
    {
        $method  = strtolower($pusher->method ?? 'post');
        $timeout = (int) data_get($pusher->provider_metadata, 'timeout', 30);
        $isTest  = (bool) data_get($pusher->provider_metadata, 'is_test', false);
        $body    = $this->decodeBody($log);

        $url = $isTest
            ? str_replace('/webhook/', '/webhook-test/', $pusher->url)
            : $pusher->url;

        $request = Http::acceptJson()->timeout($timeout);

        if ($pusher->require_auth && $pusher->token) {
            if ($pusher->auth_header) {
                $request = $request->withHeaders([$pusher->auth_header => $pusher->token]);
            } else {
                $request = $request->withToken($pusher->token);
            }
        }

        $response = $request->$method($url, $body);

        return new PusherResult(
            $response->successful(),
            $response->status(),
            $response->body(),
        );
    }

    /**
     * External HTTP endpoint: repeated 404/410/401/403 responses auto-disable the
     * pusher (see PushersService::handleFailedPush).
     */
    protected function supportsAutoDisable(): bool
    {
        return true;
    }
}
