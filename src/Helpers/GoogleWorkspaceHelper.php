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

    public const SCOPE_GMAIL_SEND = 'https://www.googleapis.com/auth/gmail.send';
    public const SCOPE_CALENDAR_READONLY = 'https://www.googleapis.com/auth/calendar.readonly';
    public const SCOPE_CONTACTS_READONLY = 'https://www.googleapis.com/auth/contacts.readonly';

    /**
     * Whether the service row was granted the given scope at consent time.
     */
    public static function hasScope(ExternalServices $service, string $scope): bool
    {
        // normalized so connections holding the old full-access scopes still count
        return in_array($scope, self::normalizeScopes($service->configuration['allowed_scopes'] ?? []), true);
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
     * it first when the access token is expired or about to expire. Returns null when it cannot be refreshed;
     * a permanent failure (revoked/expired refresh token) also flags the connection as needing a reconnect.
     */
    public static function freshEncryptedToken(ExternalServices $service): ?string
    {
        $expiresAt = $service->configuration['expires_at'] ?? null;

        if ($expiresAt && now()->addMinutes(5)->lt($expiresAt)) {
            return $service->token;
        }

        return self::refresh($service)['token'];
    }

    /**
     * Calls Google's token endpoint and keeps the connection's state truthful:
     * - on success: stores the new token and the scopes Google says were really granted, and records health
     *   (ok, or needs_reconnect with missing_scopes when a required scope is not granted);
     * - on invalid_grant (the user revoked access, the refresh token expired): health needs_reconnect / token_revoked;
     * - on any other failure (network, 5xx): nothing is flagged, it is treated as transient.
     *
     * @return array{token: ?string, permanent_failure: bool, error: ?string} error is a short reason for diagnostics
     */
    public static function refresh(ExternalServices $service): array
    {
        $result = ['token' => null, 'permanent_failure' => false, 'error' => null];

        if (empty($service->refresh_token)) {
            self::recordHealth($service, 'needs_reconnect', 'no_refresh_token');
            $result['permanent_failure'] = true;
            $result['error']             = 'no refresh token stored';

            return $result;
        }

        try {
            $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
                'client_id'     => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                // only 'token' is encrypted by the model; tolerate both forms for the refresh token
                'refresh_token' => self::decryptOrRaw($service->refresh_token),
                'grant_type'    => 'refresh_token',
            ]);
        } catch (\Throwable $e) {
            Log::warning('[Commons::GoogleWorkspaceHelper] Token refresh unreachable', [
                'external_service_uuid' => $service->uuid,
                'error'                 => $e->getMessage(),
            ]);

            $result['error'] = 'unreachable: ' . $e->getMessage();

            return $result;
        }

        if (!$response->successful() || empty($response->json('access_token'))) {
            Log::warning('[Commons::GoogleWorkspaceHelper] Token refresh failed', [
                'external_service_uuid' => $service->uuid,
                'response'              => $response->json(),
            ]);

            $result['error'] = $response->status() . ' ' . ($response->json('error') ?? '') . ' ' . ($response->json('error_description') ?? '');

            // invalid_grant = revoked or expired refresh token: only a new consent can fix it
            if ($response->json('error') === 'invalid_grant') {
                self::recordHealth($service, 'needs_reconnect', 'token_revoked');
                $result['permanent_failure'] = true;
            }

            return $result;
        }

        $fresh         = $service->fresh();
        $configuration = $fresh->configuration ?? [];
        $granted       = self::normalizeScopes(explode(' ', (string) $response->json('scope', '')));

        $configuration['expires_at'] = now()->addSeconds($response->json('expires_in', 3600))->toISOString();

        // Google reports what was really granted (the user may have unticked scopes); keep it when present
        if (!empty($granted)) {
            $configuration['allowed_scopes'] = $granted;
        }

        $configuration['health'] = self::healthFor($configuration['allowed_scopes'] ?? []);

        ExternalServicesService::update($service->uuid, [
            'token'         => $response->json('access_token'),
            'configuration' => $configuration,
        ]);

        $result['token'] = $fresh->fresh()->token;

        return $result;
    }

    /**
     * Health block for a list of granted scopes: ok, or needs_reconnect/scope_missing with the missing scopes.
     */
    public static function healthFor(array $grantedScopes): array
    {
        $missing = array_values(array_diff(
            [self::SCOPE_GMAIL_SEND, self::SCOPE_CALENDAR_READONLY, self::SCOPE_CONTACTS_READONLY],
            $grantedScopes
        ));

        return [
            'status'         => empty($missing) ? 'ok' : 'needs_reconnect',
            'reason'         => empty($missing) ? null : 'scope_missing',
            'missing_scopes' => $missing,
            'checked_at'     => now()->toISOString(),
        ];
    }

    /**
     * A full-access scope covers its read-only sibling (connections made before the scopes were narrowed hold the
     * full 'calendar' / 'contacts' scopes), so the read-only scope is added to the granted list.
     */
    public static function normalizeScopes(array $scopes): array
    {
        $scopes = array_values(array_filter(array_map('trim', $scopes)));

        if (in_array('https://www.googleapis.com/auth/calendar', $scopes, true)) {
            $scopes[] = self::SCOPE_CALENDAR_READONLY;
        }

        if (in_array('https://www.googleapis.com/auth/contacts', $scopes, true)) {
            $scopes[] = self::SCOPE_CONTACTS_READONLY;
        }

        return array_values(array_unique($scopes));
    }

    /**
     * Records the connection health the panel shows: ['status' => ok|needs_reconnect, 'reason' => ..., 'checked_at'].
     */
    public static function recordHealth(ExternalServices $service, string $status, ?string $reason = null, array $missingScopes = []): void
    {
        $service = $service->fresh();

        ExternalServicesService::update($service->uuid, [
            'configuration' => array_merge($service->configuration ?? [], ['health' => [
                'status'         => $status,
                'reason'         => $reason,
                'missing_scopes' => $missingScopes,
                'checked_at'     => now()->toISOString(),
            ]]),
        ]);
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
