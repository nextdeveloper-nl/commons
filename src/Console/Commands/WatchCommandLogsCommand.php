<?php

namespace NextDeveloper\Commons\Console\Commands;

use Illuminate\Console\Command;
use NextDeveloper\Events\Services\NatsService;

/**
 * Live monitor of the command history: prints every command as it is recorded, read from NATS.
 *
 *   php artisan commons:watch-command-logs                       everything, all accounts (platform.commands)
 *   php artisan commons:watch-command-logs --module=monitoring   only one module
 *   php artisan commons:watch-command-logs --operation=delete    only deletes
 *   php artisan commons:watch-command-logs --account=<uuid>      one account (client.{uuid}.commands)
 *
 * Runs until stopped (Ctrl+C). Connects server side like the other NATS commands, so it needs NATS_ENABLED and the
 * server credentials of the Events module.
 */
class WatchCommandLogsCommand extends Command
{
    protected $signature = 'commons:watch-command-logs
                            {--account= : only this account (uuid)}
                            {--module= : only this module}
                            {--operation= : only this operation (create|update|delete|read|system)}
                            {--status= : only this status (success|failed|blocked)}
                            {--json : print the raw payload object as JSON}';

    protected $description = 'Live monitor: prints each recorded command as it happens (from NATS).';

    public function handle(NatsService $nats): int
    {
        if (! config('events.nats.enabled', false)) {
            $this->error('NATS is not enabled (events.nats.enabled / NATS_ENABLED).');

            return self::FAILURE;
        }

        $subject = $this->option('account')
            ? str_replace('{account_uuid}', $this->option('account'), config('commons.command_logs.nats.client_subject') ?: 'client.{account_uuid}.commands')
            : (config('commons.command_logs.nats.platform_subject') ?: 'platform.commands');

        $this->info("Watching {$subject} (Ctrl+C to stop)");

        $nats->subscribe($subject, function ($message) {
            $o = is_array($message) ? ($message['payload']['object'] ?? null) : null;

            if (! $o || $this->filteredOut($o)) {
                return;
            }

            if ($this->option('json')) {
                $this->line(json_encode($o, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

                return;
            }

            $this->line(sprintf(
                '%s  %-7s %-8s %-40s %-7s acct=%s user=%s obj=%s',
                substr((string) ($o['created_at'] ?? ''), 11, 8),
                $o['operation'] ?? '?',
                $o['status'] ?? '?',
                $o['action'] ?? '?',
                $o['http_status'] ?? '-',
                $o['account_id'] ?? '-',
                $o['user_name'] ?? ($o['iam_user_id'] ?? 'system'),
                $o['object_id'] ?? '-'
            ));
        });

        while (true) {
            $nats->process(1.0);
        }
    }

    private function filteredOut(array $o): bool
    {
        foreach (['module', 'operation', 'status'] as $field) {
            if ($this->option($field) && ($o[$field] ?? null) !== $this->option($field)) {
                return true;
            }
        }

        return false;
    }
}
