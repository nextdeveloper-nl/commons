-- PostgreSQL

-- Project-wide command history: who did what through the API (or the platform itself) in any module.
-- Append-only: rows are never updated; old rows are removed only by the prune command (reads 90 days, create/update 1 year,
-- delete and system events are kept). Not to be confused with common_action_logs, which records runs of platform Actions.

CREATE SEQUENCE IF NOT EXISTS common_command_logs_id_seq;

CREATE TABLE common_command_logs (
    id               bigint NOT NULL DEFAULT nextval('common_command_logs_id_seq'::regclass),
    uuid             uuid DEFAULT gen_random_uuid(), -- [ro]
    iam_account_id   bigint, -- Account the command belongs to. Null only for platform actions that belong to no account.
    iam_user_id      bigint, -- Who did it (UserHelper::me()->id). Null for system actions (jobs, console, automatic recovery).
    module           text NOT NULL, -- First path segment or the calling module, e.g. monitoring, iaas, crm, s3
    resource         text, -- Route derived, e.g. monitoring/hosts
    operation        text NOT NULL, -- create | update | delete | read | system
    action           text NOT NULL, -- e.g. hosts.create, tenant.remote-delete, tenant.empty
    object_type      text, -- Full model class when known, e.g. NextDeveloper\Monitoring\Models\MonitoringTenant
    object_id        text, -- uuid or id of the object the command was about
    source           text NOT NULL DEFAULT 'api', -- api | system | console | job
    http_method      text,
    path             text,
    request_id       text,
    ip_address       text,
    user_agent       text,
    request          json, -- Only the names of the fields sent (never their values), so no personal data or secrets are stored
    context          json, -- Reason, before/after summary, trimmed backtrace for system actions
    status           text NOT NULL DEFAULT 'success', -- success | failed | blocked
    http_status      integer,
    error            text,
    created_at       timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT common_command_logs_pkey PRIMARY KEY (id),
    CONSTRAINT common_command_logs_iam_account_id_foreign FOREIGN KEY (iam_account_id) REFERENCES iam_accounts(id) ON DELETE SET NULL,
    CONSTRAINT common_command_logs_iam_user_id_foreign FOREIGN KEY (iam_user_id) REFERENCES iam_users(id) ON DELETE SET NULL
);

ALTER SEQUENCE common_command_logs_id_seq OWNED BY common_command_logs.id;

-- Customer view: "what happened in my account lately"
CREATE INDEX common_command_logs_account_created_idx ON public.common_command_logs USING btree (iam_account_id, created_at DESC);
-- Admin view per module, and the prune command
CREATE INDEX common_command_logs_module_created_idx ON public.common_command_logs USING btree (module, created_at DESC);
-- "History of this object"
CREATE INDEX common_command_logs_object_idx ON public.common_command_logs USING btree (object_type, object_id);
-- Prune command and operation filters
CREATE INDEX common_command_logs_operation_created_idx ON public.common_command_logs USING btree (operation, created_at);
-- "What did this user do"
CREATE INDEX common_command_logs_user_idx ON public.common_command_logs USING btree (iam_user_id);
