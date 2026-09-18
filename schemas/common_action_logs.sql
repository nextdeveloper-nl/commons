-- PostgreSQL

CREATE TABLE common_action_logs (
    id                bigint NOT NULL DEFAULT nextval('common_action_logs_id_seq'::regclass),
    uuid              uuid DEFAULT gen_random_uuid(), -- [ro]
    common_action_id  bigint NOT NULL,
    log               json NOT NULL,
    runtime           integer,
    created_at        timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    iam_account_id    bigint,
    iam_user_id       bigint,
    CONSTRAINT common_action_logs_pkey PRIMARY KEY (id)
);
