<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\ExternalServices;
use NextDeveloper\Commons\Services\ExternalServicesService;

/**
 * Shared helpers for the 'google_workspace' ExternalServices rows created by the Workspace connect flow.
 * Calendar sync (Agenda) and contacts import (Communication) both need to find rows that were granted a
 * given scope and to get an access token that is guaranteed to be fresh.
 */
class GoogleWorkspaceHelper
{
    public const CODE = 'google_workspace';

    public const SCOPE_CALENDAR_READONLY = 'https://www.googleapis.com/auth/calendar.readonly';
    public const SCOPE_CONTACTS_READONLY = 'https://www.googleapis.com/auth/contacts.readonly';

    /**
     * Whether the service row was granted the given scope at consent time.
     */
    public static function hasScope(ExternalServices $service, string $scope): bool
    {
        return in_array($scope, $service->configuration['allowed_scopes'] ?? [], true);
    }

    /**
     * Live google_workspace rows that hold the given scope. Optionally limited to one user.
     * Scopes live in a JSON column, so they are filtered in PHP rather than in SQL.
     */
    public static function servicesWithScope(string $scope, ?int $userId = null): \Illuminate\Support\Collection
    {
        $query = ExternalServices::withoutGlobalScopes()
            ->where('code', self::CODE)
            ->where('is_alive', true)
            ->whereNull('deleted_at');

        if ($userId) {
            $query->where('iam_user_id', $userId);
        }

        return $query->get()->filter(fn (ExternalServices $service) => self::hasScope($service, $scope))->values();
    }

    /**
     * Returns the encrypted token as stored (what the Agenda Google client expects), refreshing and persisting
     * it first when the access token is expired or about to expire. Returns null when it cannot be refreshed.
     */
    public static function freshEncryptedToken(ExternalServices $service): ?string
    {
        $expiresAt = $service->configuration['expires_at'] ?? null;

        if ($expiresAt && now()->addMinutes(5)->lt($expiresAt)) {
            return $service->token;
        }

        if (empty($service->refresh_token)) {
            return null;
        }

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id'     => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            // only 'token' is encrypted by the model; tolerate both forms for the refresh token
            'refresh_token' => self::decryptOrRaw($service->refresh_token),
            'grant_type'    => 'refresh_token',
        ]);

        if (!$response->successful() || empty($response->json('access_token'))) {
            Log::warning('[Commons::GoogleWorkspaceHelper] Token refresh failed', [
                'external_service_uuid' => $service->uuid,
                'response'              => $response->json(),
            ]);

            return null;
        }

        ExternalServicesService::update($service->uuid, [
            'token'         => $response->json('access_token'),
            'configuration' => array_merge($service->configuration ?? [], [
                'expires_at' => now()->addSeconds($response->json('expires_in', 3600))->toISOString(),
            ]),
        ]);

        return $service->fresh()->token;
    }

    /**
     * Plain access token for direct HTTP calls (People API etc.), refreshed when needed.
     */
    public static function freshAccessToken(ExternalServices $service): ?string
    {
        $encrypted = self::freshEncryptedToken($service);

        return $encrypted ? self::decryptOrRaw($encrypted) : null;
    }

    /**
     * Merge a status block into configuration (e.g. 'contacts_sync', 'calendar_sync') for the panel to display.
     */
    public static function recordSync(ExternalServices $service, string $key, array $status): void
    {
        $service = $service->fresh();

        ExternalServicesService::update($service->uuid, [
            'configuration' => array_merge($service->configuration ?? [], [$key => $status]),
        ]);
    }

    private static function decryptOrRaw(string $value): string
    {
        try {
            return decrypt($value);
        } catch (\Throwable) {
            return $value;
        }
    }
}
