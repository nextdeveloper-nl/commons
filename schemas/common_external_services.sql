-- PostgreSQL

CREATE TABLE common_external_services (
    id              bigint NOT NULL DEFAULT nextval('common_external_services_id_seq'::regclass),
    uuid            uuid NOT NULL DEFAULT gen_random_uuid(),
    code            text,
    name            text NOT NULL,
    description     text,
    configuration   json,
    token           text NOT NULL,
    refresh_token   text,
    is_alive        boolean,
    iam_account_id  bigint,
    iam_user_id     bigint,
    created_at      timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at      timestamp with time zone,
    service_owner   text,
    CONSTRAINT common_external_services_pkey PRIMARY KEY (id)
);
