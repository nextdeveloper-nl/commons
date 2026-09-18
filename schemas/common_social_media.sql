-- PostgreSQL

CREATE TABLE common_social_media (
    id           bigint NOT NULL DEFAULT nextval('common_social_media_id_seq'::regclass),
    uuid         uuid DEFAULT gen_random_uuid(), -- [ro]
    object_id    bigint NOT NULL, -- [!model]
    object_type  text NOT NULL,
    profile_url  text NOT NULL,
    tags         text[] NOT NULL DEFAULT '{}'::text[],
    created_at   timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at   timestamp with time zone,
    CONSTRAINT common_social_media_pkey PRIMARY KEY (id)
);
