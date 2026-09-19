-- PostgreSQL

CREATE TABLE common_domains (
    id                bigint NOT NULL DEFAULT nextval('common_domains_id_seq'::regclass),
    uuid              uuid DEFAULT gen_random_uuid(), -- [ro]
    iam_account_id    bigint,
    name              text NOT NULL, -- [ui:domain][label:"Please write the domain name you want ending with TLD like .com, .net, .co.uk"]
    is_active         boolean DEFAULT true, -- [ro][label:"Is this domain actively being used?"]
    is_local_domain   boolean DEFAULT false, -- [label:"Please select this if this domain used for internal requirements like local.domain or this is a virtual domain."]
    is_locked         boolean DEFAULT false, -- [ro]
    is_shared_domain  boolean DEFAULT false, -- [ro]
    is_validated      boolean DEFAULT false, -- [ro]
    tags              text[] NOT NULL DEFAULT '{}'::text[],
    created_at        timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at        timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at        timestamp with time zone,
    description       text, -- [ui:markdown][label:"Please give us information about why and how you use this domain. This information will be used if you create yourself a marketplace."]
    is_tld            boolean DEFAULT false, -- [label:"Is this domain a top level domain ?"]
    CONSTRAINT common_domains_pkey PRIMARY KEY (id),
    CONSTRAINT common_domains_name_pk UNIQUE (name)
);
