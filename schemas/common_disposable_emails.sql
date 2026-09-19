-- PostgreSQL

CREATE TABLE common_disposable_emails (
    id                bigint NOT NULL DEFAULT nextval('common_disposable_emails_id_seq'::regclass),
    uuid              uuid DEFAULT gen_random_uuid(),
    common_domain_id  bigint NOT NULL,
    created_at        timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at        timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at        timestamp with time zone,
    CONSTRAINT common_disposable_emails_pkey PRIMARY KEY (id)
);
