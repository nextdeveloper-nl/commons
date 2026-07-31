-- PostgreSQL
-- Stores outbound push endpoint configurations for Commons integrations.

CREATE TABLE common_pushers (
    id                 bigint NOT NULL DEFAULT nextval('common_pushers_id_seq'::regclass),
    uuid               uuid DEFAULT gen_random_uuid(),
    name               text NOT NULL, -- Human-readable name of the pusher configuration.
    description        text, -- Optional description explaining the purpose of the pusher.
    require_auth       boolean NOT NULL DEFAULT false, -- Determines whether authenticated requests should include the token.
    token              text, -- Bearer or secret token used for authenticated push requests.
    url                text NOT NULL, -- Destination endpoint URL where payloads will be pushed.
    method             text NOT NULL DEFAULT 'POST'::text, -- HTTP method used for the push request, such as POST or PUT.
    iam_user_id        bigint, -- User who created or owns the pusher configuration.
    iam_account_id     bigint, -- Account that owns the pusher configuration.
    created_at         timestamp with time zone NOT NULL DEFAULT now(),
    updated_at         timestamp with time zone NOT NULL DEFAULT now(),
    deleted_at         timestamp with time zone,
    provider           text DEFAULT 'generic'::text, -- The provider type for the pusher configuration, such as generic, slack, teams, etc. This can be used to apply provider-specific logic when executing pushes.
    provider_metadata  json, -- JSON field for storing additional metadata specific to the provider type. For example, for a Slack provider, this could include the channel ID or username to post to. For a generic provider, this could include any custom configuration needed for the push.
    auth_header        text DEFAULT 'Authorization'::text, -- The header key used for authentication when require_auth is true. Defaults to "Authorization", but can be customized for different providers that may expect a different header key for the token.
    CONSTRAINT common_pushers_pkey PRIMARY KEY (id)
);

CREATE INDEX common_pushers_iam_account_id_idx ON public.common_pushers USING btree (iam_account_id);
CREATE INDEX common_pushers_iam_user_id_idx ON public.common_pushers USING btree (iam_user_id);
