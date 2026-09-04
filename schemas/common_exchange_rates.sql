-- PostgreSQL

CREATE TABLE common_exchange_rates (
    id                       bigint NOT NULL DEFAULT nextval('common_exchange_rates_id_seq'::regclass),
    uuid                     uuid DEFAULT gen_random_uuid(), -- [ro]
    common_country_id        bigint NOT NULL,
    rate                     numeric(20,10) NOT NULL,
    created_at               timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at               timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    reference_currency_code  text NOT NULL,
    source                   text,
    local_currency_code      text,
    CONSTRAINT common_exchange_rates_pkey PRIMARY KEY (id)
);
