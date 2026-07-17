<?php

namespace NextDeveloper\Commons\Http\Controllers\FailedJobs;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Services\FailedJobsService;
use NextDeveloper\IAM\Authorization\Roles\SystemAdminRole;
use NextDeveloper\IAM\Helpers\UserHelper;

class FailedJobsController extends AbstractController
{
    public function index(Request $request): JsonResponse
    {
        if (! $this->isAuthorized($request)) {
            return response()->json([
                'message' => 'Forbidden: only system-admin role or a valid failed-jobs API token can read and clear failed jobs.',
            ], 403);
        }

        $validated = $request->validate([
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        $limit = (int) ($validated['limit'] ?? FailedJobsService::DEFAULT_LIMIT);

        $jobs = FailedJobsService::popBatch($limit);

        return $this->withArray([
            'count' => count($jobs),
            'limit' => $limit,
            'jobs'  => $jobs,
        ]);
    }

    /**
     * Allows either a logged-in system-admin user, or a caller presenting the
     * static failed-jobs API token as a bearer token — AI agents diagnosing
     * failures generally have no IAM user/OAuth token of their own, so this
     * endpoint is also reachable via a shared secret sourced from the
     * FAILED_JOBS_API_TOKEN env var (config('commons.failed_jobs.api_token')).
     * This route is listed in `app.anonymous_uris`, so the global IAM
     * Authenticate/Authorize middleware never runs for it — this check is the
     * only gate, which is why an unset/empty configured token must never
     * match (it would otherwise allow anyone through with no bearer token).
     */
    private function isAuthorized(Request $request): bool
    {
        // UserHelper::hasRole() assumes an authenticated user; calling it for a
        // fully anonymous request (no bearer token at all, e.g. an unauthenticated
        // AI-agent call) throws inside UserHelper::getRoles(), so only try the
        // role check once we know a user actually resolved.
        if (UserHelper::me() && UserHelper::hasRole(SystemAdminRole::NAME)) {
            return true;
        }

        $configuredToken = config('commons.failed_jobs.api_token');
        $providedToken = $request->bearerToken();

        if (empty($configuredToken) || empty($providedToken)) {
            return false;
        }

        return hash_equals($configuredToken, $providedToken);
    }
}
