-- PostgreSQL

CREATE TABLE common_registries (
    id     bigint NOT NULL DEFAULT nextval('common_registries_id_seq'::regclass),
    uuid   uuid DEFAULT gen_random_uuid(),
    key    text NOT NULL,
    value  json NOT NULL,
    CONSTRAINT common_registries_pkey PRIMARY KEY (id)
);
