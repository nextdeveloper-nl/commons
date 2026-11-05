<?php

namespace NextDeveloper\Commons\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Services\CommandLogsService;

/**
 * Writes one command history row. Dispatched by CommandLogsService::record() so a request never waits for the insert.
 * The entry is already complete (account, user, request data) because a queue worker has no logged-in user.
 */
class WriteCommandLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // The history is best effort: a failed row is logged by the service and retried a couple of times, not forever.
    public $tries = 3;

    public $backoff = 10;

    public function __construct(public array $entry)
    {
        $queue = config('commons.command_logs.queue');

        if ($queue) {
            $this->onQueue($queue);
        }
    }

    public function handle(): void
    {
        // The history is best effort and must never pile up failed jobs: when the row cannot be stored (for example the
        // common_command_logs table has not been created yet on this environment) the entry is logged and dropped instead
        // of being retried and ending up in failed_jobs.
        try {
            $row = CommandLogsService::store($this->entry);
        } catch (\Throwable $e) {
            Log::warning('[CommandLogs] could not store a command, dropping it: '.$e->getMessage(), [
                'action' => $this->entry['action'] ?? null,
                'account' => $this->entry['iam_account_id'] ?? null,
            ]);

            return;
        }

        // Stored first; the live NATS push comes after and can never undo or repeat the insert.
        CommandLogsService::publish($row);
    }
}
