<?php

namespace NextDeveloper\Commons\Pushers\Drivers;

use Illuminate\Support\Facades\Http;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Pushers\AbstractPusher;
use NextDeveloper\Commons\Pushers\PusherResult;

class DefaultHttpPusher extends AbstractPusher
{
    public static function provider(): string
    {
        return 'default';
    }

    public function send(PusherLogs $log, Pushers $pusher): PusherResult
    {
        $request = Http::timeout(30);

        if ($pusher->require_auth) {
            if ($pusher->auth_header) {
                $request = $request->withHeaders([$pusher->auth_header => $pusher->token]);
            } else {
                $request = $request->withToken($pusher->token);
            }
        }

        $method = strtolower($pusher->method ?? 'post');
        $body = $this->decodeBody($log);

        $response = $request->$method($pusher->url, $body);

        return new PusherResult(
            $response->successful(),
            $response->status(),
            $response->body(),
        );
    }
}
