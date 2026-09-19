-- PostgreSQL

CREATE TABLE common_validatable (
    id               bigint NOT NULL DEFAULT nextval('common_validatable_id_seq'::regclass),
    uuid             uuid DEFAULT gen_random_uuid(), -- [ro]
    object_id        bigint NOT NULL, -- [!model]
    object_type      text NOT NULL,
    validation_code  text NOT NULL,
    created_at       timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at       timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at       timestamp with time zone,
    is_used          boolean DEFAULT false,
    CONSTRAINT common_validatable_pkey PRIMARY KEY (id)
);
