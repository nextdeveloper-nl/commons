<?php

namespace NextDeveloper\Commons\Console\Commands;

use Illuminate\Console\Command;
use NextDeveloper\Commons\Services\CommandLogsService;

/**
 * Removes command history rows that are older than the retention of their operation
 * (commons.command_logs.retention_days; null = kept forever, which is the case for delete and system events).
 * Delegates to CommandLogsService::prune(). Scheduled daily by the CommonsServiceProvider.
 */
class PruneCommandLogsCommand extends Command
{
    protected $signature = 'commons:prune-command-logs {--dry-run : only count what would be removed}';

    protected $description = 'Removes old command history rows according to commons.command_logs.retention_days.';

    public function handle(): int
    {
        foreach (CommandLogsService::prune((bool) $this->option('dry-run')) as $operation => $count) {
            $this->line(sprintf('%-8s %s %d', $operation, $this->option('dry-run') ? 'would remove' : 'removed', $count));
        }

        return self::SUCCESS;
    }
}
