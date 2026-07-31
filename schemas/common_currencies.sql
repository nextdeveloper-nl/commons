-- PostgreSQL

CREATE TABLE common_currencies (
    id                 bigint NOT NULL DEFAULT nextval('common_currencies_id_seq'::regclass),
    uuid               uuid DEFAULT gen_random_uuid(), -- [ro]
    code               text NOT NULL,
    name               text NOT NULL,
    common_country_id  bigint,
    CONSTRAINT common_currencies_pkey PRIMARY KEY (id)
);
