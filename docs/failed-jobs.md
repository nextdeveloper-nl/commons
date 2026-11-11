# Failed Jobs — AI Diagnosis Endpoint

`GET /commons/failed-jobs` gives an AI agent (or a human) a batch of Laravel's
queue failures, pre-digested into something an LLM can reason about, so the
failing job's root cause can be found and fixed in the source code.

**This endpoint deletes every row it returns, in the same request.** Calling
it "pops" that batch off the failure queue — there is no separate read-only
mode. If you call it and then don't do anything with the response, that
failure data is gone. Always capture the full response before you start
analyzing it, and don't call it speculatively "just to check."

## Endpoint

```
GET https://api.plusclouds.com/commons/failed-jobs?limit=20
```

- `limit` — optional, integer, 1–100, default 20. How many failed jobs to
  pop in this call, oldest `failed_at` first.
- No `queue`/`connection` filter exists — it pops across all queues.

## Authentication

Send the shared secret as a bearer token:

```
Authorization: Bearer <FAILED_JOBS_API_TOKEN>
```

The token value is **not** in this doc or in any source file — it's an
environment variable (`FAILED_JOBS_API_TOKEN`) configured on the server via
`config('commons.failed_jobs.api_token')`. Get the current value from
whoever operates the deployment; treat it as a credential (don't paste it
into logs, commits, or shared chat transcripts).

A logged-in `system-admin` IAM user can also call this endpoint without the
token, but that path isn't relevant for an agent with no IAM account.

Responses:
- `200` — batch returned (and deleted). `{"count": 0, "jobs": []}` if there
  was nothing to pop.
- `403` — missing/wrong token and no `system-admin` session:
  `{"message": "Forbidden: only system-admin role or a valid failed-jobs API token can read and clear failed jobs."}`

## Response shape

```json
{
  "count": 2,
  "limit": 20,
  "jobs": [
    {
      "id": 57,
      "uuid": "3ff103f3-d1e3-4461-a1fa-148d9152f200",
      "job_class": "NextDeveloper\\IAAS\\Jobs\\ComputeComputeMemberEventsJob",
      "queue": "iaas-health-check",
      "connection": "redis",
      "failed_at": "2026-05-10T17:48:59+03:00",
      "exception": {
        "class": "NextDeveloper\\Commons\\Exceptions\\NotAllowedException",
        "message": "You are not allowed to access this resource...",
        "file": "/var/www/vendor/nextdeveloper/iaas/src/Database/Observers/ComputeMemberTasksObserver.php",
        "line": 62
      },
      "trace_excerpt": [
        "#0 /var/www/vendor/laravel/framework/src/Illuminate/Events/Dispatcher.php(478): NextDeveloper\\IAAS\\Database\\Observers\\ComputeMemberTasksObserver->saving()",
        "#1 ... (up to 15 frames, then \"... (N more frames omitted)\")"
      ],
      "trace_frame_count": 27,
      "payload": {
        "__declared_class__": "NextDeveloper\\IAAS\\Jobs\\ComputeComputeMemberEventsJob",
        "computeMemberId": 4821,
        "eventType": "created"
      }
    }
  ]
}
```

| Field | Meaning |
|---|---|
| `job_class` | The queued job/command's FQCN. Start your search here — `grep -rn "class ComputeComputeMemberEventsJob"` across the vendor/app tree to find the source file. |
| `exception.class` / `message` | The thrown exception and its message — usually enough to tell you *what* went wrong. |
| `exception.file` / `line` | Where the exception was actually thrown — often a different file than the job class itself (e.g. inside an Observer, Service, or framework internal called by the job). Start root-causing here. |
| `trace_excerpt` | Up to 15 stack frames from the top, oldest-first-omitted if there are more (`trace_frame_count` has the true total). Read top-to-bottom to trace the call path from the exception site back toward the job's `handle()`. |
| `payload` | The job's constructor arguments/properties at the time it was dispatched, best-effort decoded. Keys prefixed `__declared_class__` mean the real object couldn't be fully reconstructed (defense against unsafe unserialize — see `FailedJobsService::extractCommandArgs()`), but its property values are still present. Strings over 500 chars and arrays over 20 items are truncated with a marker; this is a diagnostic summary, not a full dump. |
| `payload` = `"(command payload is encrypted or in an unrecognized format; cannot decode)"` | The job used `ShouldBeEncrypted` or a non-standard dispatch shape — you only have the exception/trace to go on for this one. |

## Suggested workflow for an agent

1. Call the endpoint with a `limit` you can actually process in one pass (don't pop more than you intend to look at — remember, popping deletes).
2. If `count` is 0, there's nothing to do.
3. For each job: use `job_class` to locate the source file, `exception.file`/`line` to find the actual failure point, `trace_excerpt` to understand the call path, and `payload` to understand what input triggered it.
4. Group jobs by `exception.class` + `job_class` first — the same bug often produces many failed rows; fix once, not per-row.
5. Make the fix, and if you want to confirm it before merging, you can manually re-trigger the same job class with similar payload data (e.g. via `php artisan tinker` dispatch) rather than waiting for it to fail again in production.
6. This endpoint doesn't retry or requeue anything — it only reads-and-deletes from `failed_jobs`. Fixing the code doesn't automatically redrive the jobs you just popped; that's a separate decision (Laravel's `queue:retry` only works on jobs still present in `failed_jobs`, which these no longer are once popped).

## Source

- Controller: `src/Http/Controllers/FailedJobs/FailedJobsController.php`
- Business logic (batch pop, formatting, exception/payload parsing): `src/Services/FailedJobsService.php`
- Model: `src/Database/Models/FailedJobs.php`
