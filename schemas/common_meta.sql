-- PostgreSQL

CREATE TABLE common_meta (
    id             bigint NOT NULL DEFAULT nextval('common_meta_id_seq'::regclass),
    uuid           uuid DEFAULT gen_random_uuid(), -- [ro]
    object_id      bigint NOT NULL, -- [!model]
    object_type    text NOT NULL,
    key            text NOT NULL,
    value          json NOT NULL,
    iam_account_id bigint, -- Owning account. Enables AuthorizationScope to restrict meta to its owner, same pattern as flow_items.
    iam_user_id    bigint, -- Owning user (token owner). Set server-side on create, never accepted from client input.
    CONSTRAINT common_meta_pkey PRIMARY KEY (id)
);

CREATE INDEX idx_common_meta_account ON public.common_meta USING btree (iam_account_id);
CREATE INDEX idx_common_meta_user ON public.common_meta USING btree (iam_user_id);
