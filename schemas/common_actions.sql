-- PostgreSQL

CREATE TABLE common_actions (
    id              bigint NOT NULL DEFAULT nextval('common_actions_id_seq'::regclass),
    uuid            uuid DEFAULT gen_random_uuid(), -- [ro]
    action          text NOT NULL,
    progress        smallint DEFAULT 0,
    runtime         integer,
    object_id       bigint NOT NULL, -- [!model]
    object_type     text NOT NULL,
    iam_user_id     bigint,
    iam_account_id  bigint,
    tags            text[] NOT NULL DEFAULT '{}'::text[],
    created_at      timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    checkpoints     json,
    state_data      json,
    CONSTRAINT common_actions_pkey PRIMARY KEY (id)
);
