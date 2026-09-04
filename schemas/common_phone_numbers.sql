-- PostgreSQL

CREATE TABLE common_phone_numbers (
    id                 bigint NOT NULL DEFAULT nextval('common_phone_numbers_id_seq'::regclass),
    uuid               uuid DEFAULT gen_random_uuid(), -- [ro]
    object_id          bigint NOT NULL, -- [!model]
    object_type        text NOT NULL,
    name               text NOT NULL,
    code               text NOT NULL,
    number             text NOT NULL,
    is_active          boolean NOT NULL DEFAULT true,
    common_country_id  bigint NOT NULL,
    tags               text[] NOT NULL DEFAULT '{}'::text[],
    created_at         timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at         timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at         timestamp with time zone,
    CONSTRAINT common_phone_numbers_pkey PRIMARY KEY (id)
);
