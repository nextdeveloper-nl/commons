-- PostgreSQL

CREATE TABLE common_states (
    id             bigint NOT NULL DEFAULT nextval('common_states_id_seq'::regclass),
    uuid           uuid DEFAULT gen_random_uuid(), -- [ro]
    name           text NOT NULL,
    value          text,
    reason         text,
    object_id      bigint NOT NULL, -- [!model]
    object_type    text NOT NULL,
    created_at     timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at     timestamp with time zone,
    object_states  object_states NOT NULL,
    CONSTRAINT common_states_pkey PRIMARY KEY (id)
);
