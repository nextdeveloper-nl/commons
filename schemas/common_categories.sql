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
    iam_account_id      bigint, -- Owner account. NULL = platform/system category (admin managed).
    iam_user_id         bigint, -- User that created the category.
    is_public           boolean NOT NULL DEFAULT false, -- true: visible to every account, false: owner account only.
    CONSTRAINT common_categories_pkey PRIMARY KEY (id)
);

CREATE INDEX common_categories_object_idx ON public.common_categories USING btree (object_type, object_id);
CREATE INDEX common_categories_iam_account_idx ON public.common_categories USING btree (iam_account_id);
CREATE INDEX common_categories_is_public_idx ON public.common_categories USING btree (is_public);

-- Tenant ownership (run manually, no Laravel migration):
-- ALTER TABLE common_categories ADD COLUMN iam_account_id bigint REFERENCES iam_accounts(id);
-- ALTER TABLE common_categories ADD COLUMN iam_user_id bigint REFERENCES iam_users(id);
-- ALTER TABLE common_categories ADD COLUMN is_public boolean NOT NULL DEFAULT false;
-- Slug is unique per owner (NULL owner = system) and domain, ignoring soft-deleted rows:
-- CREATE UNIQUE INDEX IF NOT EXISTS common_categories_owner_domain_slug_uidx
--     ON common_categories (COALESCE(iam_account_id, 0), common_domain_id, slug) WHERE deleted_at IS NULL;
-- Existing rows are system categories; keep them visible to everyone as before:
-- UPDATE common_categories SET is_public = true WHERE iam_account_id IS NULL;
