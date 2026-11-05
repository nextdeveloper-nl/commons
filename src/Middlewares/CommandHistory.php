<?php

namespace NextDeveloper\Commons\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Helpers\ClientIpHelper;
use NextDeveloper\Commons\Services\CommandLogsService;
use NextDeveloper\IAM\Helpers\UserHelper;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Project-wide command history for the API: writes one row per request saying who did what in which module.
 *
 * Register it in the application's global middleware right after the authorization middleware, so the user and account
 * are known. It does its work in terminate(), after the response has been sent, and the row itself is written by a queued
 * job (CommandLogsService::record), so a request never waits for the history. It never throws.
 *
 * Mapping: GET/HEAD = read, POST = create (also actions such as /test), PATCH/PUT = update, DELETE = delete. OPTIONS is
 * skipped. Which of create/update/read an account wants is decided in CommandLogsService::record() from the account's
 * settings; delete is always recorded. Only the names of the sent fields are stored, never their values.
 */
class CommandHistory
{
    private const OPERATIONS = [
        'GET' => 'read',
        'HEAD' => 'read',
        'POST' => 'create',
        'PUT' => 'update',
        'PATCH' => 'update',
        'DELETE' => 'delete',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        try {
            if (! config('commons.command_logs.enabled', true)) {
                return;
            }

            $operation = self::OPERATIONS[$request->method()] ?? null;

            if (! $operation || $request->is(...config('commons.command_logs.exclude', []))) {
                CommandLogsService::pullNotes();

                return;
            }

            $account = UserHelper::currentAccount();
            $user = UserHelper::me();

            // No known caller (a 401, a public route): nothing to attribute the command to.
            if (! $account || ! $user) {
                CommandLogsService::pullNotes();

                return;
            }

            $path = trim($request->path(), '/');
            [$resource, $objectId] = $this->resourceOf($path);
            $notes = CommandLogsService::pullNotes();
            $httpStatus = $response->getStatusCode();

            CommandLogsService::record([
                'iam_account_id' => $account->id,
                'iam_user_id' => $user->id,
                'module' => explode('/', $path)[0] ?: 'api',
                'resource' => $resource,
                'operation' => $operation,
                'action' => $this->actionOf($resource, $operation),
                'object_type' => $notes['object_type'] ?? null,
                'object_id' => $notes['object_id'] ?? $objectId,
                'source' => 'api',
                'http_method' => $request->method(),
                'path' => '/'.$path,
                'request_id' => $request->headers->get('X-Request-Id') ?: $request->headers->get('X-Correlation-Id'),
                // The customer's address, not the proxy's (see ClientIpHelper): $request->ip() gave the server's own IP
                'ip_address' => ClientIpHelper::resolve($request),
                'user_agent' => Str::limit((string) $request->userAgent(), 500, ''),
                // Field names only: values can hold personal data or secrets
                'request' => array_keys($request->except(['_token'])) ?: null,
                'context' => $notes['context'] ?? null,
                'status' => $httpStatus < 400 ? 'success' : (in_array($httpStatus, [401, 403], true) ? 'blocked' : 'failed'),
                'http_status' => $httpStatus,
            ]);
        } catch (Throwable $e) {
            logger()->warning('[CommandLogs] middleware could not record the request: '.$e->getMessage());
        }
    }

    /**
     * monitoring/hosts/5c1e...-uuid/checks => ['monitoring/hosts/{id}/checks', '5c1e...-uuid']
     * Uuid (or numeric) segments become {id}; the last one is the object the command was about.
     *
     * @return array{0: string, 1: ?string}
     */
    private function resourceOf(string $path): array
    {
        $objectId = null;
        $segments = [];

        foreach (explode('/', $path) as $segment) {
            if (Str::isUuid($segment) || ctype_digit($segment)) {
                $objectId = $segment;
                $segments[] = '{id}';
            } else {
                $segments[] = $segment;
            }
        }

        return [implode('/', $segments), $objectId];
    }

    /** monitoring/hosts/{id}/checks + create => monitoring.hosts.checks.create */
    private function actionOf(string $resource, string $operation): string
    {
        $parts = array_filter(explode('/', $resource), fn ($p) => $p !== '{id}');

        return implode('.', $parts).'.'.$operation;
    }
}
