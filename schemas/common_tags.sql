-- PostgreSQL

CREATE TABLE common_tags (
    id              bigint NOT NULL DEFAULT nextval('common_tags_id_seq'::regclass),
    uuid            uuid DEFAULT gen_random_uuid(), -- [ro]
    name            text NOT NULL,
    description     text,
    slug            text NOT NULL,
    iam_account_id  bigint,
    created_at      timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at      timestamp with time zone,
    CONSTRAINT common_tags_pkey PRIMARY KEY (id)
);
