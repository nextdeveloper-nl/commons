-- PostgreSQL

CREATE TABLE common_country_states (
    id                 bigint NOT NULL DEFAULT nextval('common_country_states_id_seq'::regclass),
    uuid               uuid DEFAULT gen_random_uuid(), -- [ro]
    name               text NOT NULL,
    code               text,
    latitude           text,
    longitude          text,
    type               text,
    common_country_id  bigint NOT NULL,
    is_active          boolean NOT NULL DEFAULT true,
    timezones          json,
    CONSTRAINT common_country_states_pkey PRIMARY KEY (id)
);
