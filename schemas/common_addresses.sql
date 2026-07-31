-- PostgreSQL

CREATE TABLE common_addresses (
    id                  bigint NOT NULL DEFAULT nextval('common_addresses_id_seq'::regclass),
    uuid                uuid DEFAULT gen_random_uuid(), -- [ro]
    object_id           bigint NOT NULL, -- [!model]
    object_type         text NOT NULL,
    name                text NOT NULL DEFAULT 'Primary Address'::text,
    line1               text NOT NULL,
    line2               text,
    city                text NOT NULL,
    state               text,
    state_code          text,
    postcode            text,
    is_invoice_address  boolean NOT NULL DEFAULT true,
    common_country_id   bigint NOT NULL,
    email_address       text,
    iam_account_id      bigint NOT NULL,
    created_at          timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at          timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at          timestamp with time zone,
    CONSTRAINT common_addresses_pkey PRIMARY KEY (id)
);
