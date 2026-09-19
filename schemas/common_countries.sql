-- PostgreSQL

CREATE TABLE common_countries (
    id                 bigint NOT NULL DEFAULT nextval('common_countries_id_seq'::regclass),
    uuid               uuid DEFAULT gen_random_uuid(), -- [ro]
    code               text NOT NULL,
    locale             text,
    name               text NOT NULL,
    currency_code      text,
    phone_code         text,
    vat_rate           numeric(3,0) NOT NULL DEFAULT 0.18, -- [ro] Rate is stored as numeric value, like 0.18
    continent_name     text,
    continent_code     text,
    geo_name_identity  integer,
    is_active          boolean NOT NULL DEFAULT true,
    timezones          json,
    CONSTRAINT common_countries_pkey PRIMARY KEY (id)
);
