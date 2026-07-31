-- PostgreSQL

CREATE TABLE common_comments (
    id           bigint NOT NULL DEFAULT nextval('common_comments_id_seq'::regclass),
    uuid         uuid DEFAULT gen_random_uuid(), -- [ro]
    body         text NOT NULL, -- [ui:markdown]
    iam_user_id  bigint NOT NULL,
    object_id    bigint NOT NULL, -- [!model]
    object_type  text NOT NULL,
    parent_id    bigint, -- [!model][ro]
    tags         text[] NOT NULL DEFAULT '{}'::text[],
    created_at   timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at   timestamp with time zone,
    object_uuid  uuid,
    CONSTRAINT common_comments_pkey PRIMARY KEY (id)
);
