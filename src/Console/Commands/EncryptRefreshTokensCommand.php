<?php

namespace NextDeveloper\Commons\Console\Commands;

use Illuminate\Console\Command;
use NextDeveloper\Commons\Database\Models\ExternalServices;
use NextDeveloper\Commons\Services\ExternalServicesService;

/**
 * Encrypts the refresh tokens that were stored in plain text before the model encrypted them.
 * Safe to run more than once: tokens that are already encrypted are skipped.
 */
class EncryptRefreshTokensCommand extends Command
{
    protected $signature = 'commons:encrypt-refresh-tokens {--dry-run : Only count what would be encrypted}';

    protected $description = 'Encrypts plain-text refresh tokens stored in common_external_services.';

    public function handle(): int
    {
        $encrypted = 0;
        $skipped   = 0;

        ExternalServices::withoutGlobalScopes()
            ->whereNotNull('refresh_token')
            ->where('refresh_token', '!=', '')
            ->chunkById(100, function ($services) use (&$encrypted, &$skipped) {
                foreach ($services as $service) {
                    $raw = $service->getRawOriginal('refresh_token');

                    try {
                        decrypt($raw);
                        $skipped++;

                        continue;
                    } catch (\Throwable) {
                        // plain text, encrypted below
                    }

                    if (!$this->option('dry-run')) {
                        // The model mutator encrypts the value on update
                        ExternalServicesService::update($service->uuid, ['refresh_token' => $raw]);
                    }

                    $encrypted++;
                }
            });

        $this->info(($this->option('dry-run') ? 'Would encrypt: ' : 'Encrypted: ') . $encrypted . ', already encrypted: ' . $skipped);

        return self::SUCCESS;
    }
}
