-- PostgreSQL
-- Stores request and response logs for outbound pusher operations.

CREATE TABLE common_pusher_logs (
    id                bigint NOT NULL DEFAULT nextval('common_pusher_logs_id_seq'::regclass),
    uuid              uuid DEFAULT gen_random_uuid(),
    common_pusher_id  bigint NOT NULL, -- Reference to the pusher configuration that triggered the request.
    status            text NOT NULL DEFAULT 'pending'::text, -- Execution status of the push attempt.
    object_id         bigint, -- Identifier of the related domain object that was pushed.
    object_type       text, -- Model or entity type of the related pushed object.
    body              json,
    response_code     integer, -- HTTP response status code returned by the remote endpoint.
    response_body     json, -- Raw JSON response payload returned by the remote endpoint.
    iam_user_id       bigint, -- User context under which the push action was executed.
    iam_account_id    bigint, -- Account context under which the push action was executed.
    created_at        timestamp with time zone NOT NULL DEFAULT now(),
    updated_at        timestamp with time zone NOT NULL DEFAULT now(),
    deleted_at        timestamp with time zone,
    CONSTRAINT common_pusher_logs_common_pusher_id_foreign FOREIGN KEY (common_pusher_id) REFERENCES common_pushers(id) ON DELETE CASCADE,
    CONSTRAINT common_pusher_logs_pkey PRIMARY KEY (id)
);

CREATE INDEX common_pusher_logs_common_pusher_id_idx ON public.common_pusher_logs USING btree (common_pusher_id);
CREATE INDEX common_pusher_logs_iam_account_id_idx ON public.common_pusher_logs USING btree (iam_account_id);
CREATE INDEX common_pusher_logs_iam_user_id_idx ON public.common_pusher_logs USING btree (iam_user_id);
CREATE INDEX common_pusher_logs_object_idx ON public.common_pusher_logs USING btree (object_id, object_type);
