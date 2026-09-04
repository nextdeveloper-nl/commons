-- PostgreSQL

CREATE TABLE common_meta (
    id           bigint NOT NULL DEFAULT nextval('common_meta_id_seq'::regclass),
    uuid         uuid DEFAULT gen_random_uuid(), -- [ro]
    object_id    bigint NOT NULL, -- [!model]
    object_type  text NOT NULL,
    key          text NOT NULL,
    value        json NOT NULL,
    CONSTRAINT common_meta_pkey PRIMARY KEY (id)
);
