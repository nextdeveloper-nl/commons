<?php

namespace NextDeveloper\Commons\Pushers;

use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\IAM\Helpers\UserHelper;

abstract class AbstractPusher implements PusherInterface
{
    abstract public function send(PusherLogs $log, Pushers $pusher): PusherResult;

    final public function execute(PusherLogs $log, Pushers $pusher): void
    {
        UserHelper::runAsAdmin(function () use ($log, $pusher): void {
            try {
                $result = $this->send($log, $pusher);

                $log->update([
                    'response_code' => $result->responseCode,
                    'response_body' => $result->responseBody,
                    'status' => $result->success ? 'completed' : 'failed',
                ]);

                Log::info('[Pusher] Executed', [
                    'provider' => static::provider(),
                    'pusher_log_id' => $log->id,
                    'response_code' => $result->responseCode,
                    'success' => $result->success,
                ]);
            } catch (\Throwable $e) {
                Log::error('[Pusher] Failed', [
                    'provider' => static::provider(),
                    'pusher_log_id' => $log->id,
                    'error' => $e->getMessage(),
                ]);

                $log->update([
                    'status' => 'failed',
                    'response_body' => $e->getMessage(),
                ]);

                throw $e;
            }
        });
    }

    protected function decodeBody(PusherLogs $log): array
    {
        $body = $log->body;

        if (is_string($body)) {
            return json_decode($body, true) ?? [];
        }

        return $body ?? [];
    }
}
