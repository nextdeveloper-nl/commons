-- PostgreSQL

CREATE TABLE common_media (
    id                 bigint NOT NULL DEFAULT nextval('common_media_id_seq'::regclass),
    uuid               uuid DEFAULT gen_random_uuid(), -- [ro]
    object_id          bigint, -- [!model]
    object_type        text,
    collection_name    text,
    name               text,
    cdn_url            text,
    file_name          text,
    mime_type          text,
    disk               text,
    size               bigint,
    manipulations      json,
    custom_properties  json,
    order_column       integer,
    tags               text[] NOT NULL DEFAULT '{}'::text[],
    created_at         timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at         timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at         timestamp with time zone,
    iam_account_id     bigint,
    iam_user_id        bigint,
    CONSTRAINT common_media_pkey PRIMARY KEY (id)
);
