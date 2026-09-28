<?php

namespace NextDeveloper\Commons\Pushers;

use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Services\PushersService;
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

                // A failed push to an external endpoint may mean the endpoint is gone
                // or the credentials were revoked; after repeated permanent failures
                // the pusher is disabled and its owner emailed. Must never break the push.
                if (!$result->success && $this->supportsAutoDisable()) {
                    try {
                        PushersService::handleFailedPush($pusher, $result->responseCode, $result->responseBody);
                    } catch (\Throwable $e) {
                        Log::error('[Pusher] Auto-disable check failed', [
                            'pusher_log_id' => $log->id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
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

    /**
     * Whether repeated permanent failures (404/410/401/403) may auto-disable this
     * pusher. Only drivers that call an external HTTP endpoint opt in: for internal
     * drivers (e.g. Flow pushers) a 404/422 means one bad item, not a broken pusher.
     */
    protected function supportsAutoDisable(): bool
    {
        return false;
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
