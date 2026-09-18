-- PostgreSQL

CREATE TABLE common_cities (
    id                  bigint NOT NULL DEFAULT nextval('common_cities_id_seq'::regclass),
    uuid                uuid DEFAULT gen_random_uuid(),
    code                text NOT NULL,
    locale              text,
    name                text NOT NULL,
    phone_code          text,
    geo_name_identitiy  integer,
    common_country_id   bigint NOT NULL,
    is_active           boolean NOT NULL DEFAULT true,
    timezones           json,
    CONSTRAINT common_cities_pkey PRIMARY KEY (id)
);
