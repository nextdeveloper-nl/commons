-- PostgreSQL

CREATE TABLE common_votes (
    id           bigint NOT NULL DEFAULT nextval('common_votes_id_seq'::regclass),
    uuid         uuid DEFAULT gen_random_uuid(), -- [ro]
    value        smallint NOT NULL,
    object_id    bigint NOT NULL, -- [!model]
    object_type  text NOT NULL,
    iam_user_id  bigint NOT NULL,
    created_at   timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at   timestamp with time zone,
    CONSTRAINT common_votes_pkey PRIMARY KEY (id)
);
