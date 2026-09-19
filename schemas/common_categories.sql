-- PostgreSQL

CREATE TABLE common_categories (
    id                  bigint NOT NULL DEFAULT nextval('common_categories_id_seq'::regclass),
    uuid                uuid DEFAULT gen_random_uuid(), -- [ro]
    slug                text NOT NULL,
    name                text NOT NULL,
    description         text,
    url                 text,
    is_active           boolean DEFAULT true,
    common_domain_id    bigint NOT NULL,
    common_category_id  bigint, -- This is the parent category id of the object.
    created_at          timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at          timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at          timestamp with time zone,
    position            smallint DEFAULT 0,
    object_type         text,
    object_id           bigint, -- [!model]
    CONSTRAINT common_categories_pkey PRIMARY KEY (id)
);

CREATE INDEX common_categories_object_idx ON public.common_categories USING btree (object_type, object_id);
