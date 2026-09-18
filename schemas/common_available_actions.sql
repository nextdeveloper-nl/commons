-- PostgreSQL

CREATE TABLE common_available_actions (
    id           bigint NOT NULL DEFAULT nextval('common_available_actions_id_seq'::regclass),
    uuid         uuid DEFAULT gen_random_uuid(),
    action       text NOT NULL,
    description  text NOT NULL,
    class        text NOT NULL,
    input        text,
    parameters   json NOT NULL,
    created_at   timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at   timestamp with time zone,
    outputs      json,
    name         text,
    CONSTRAINT common_available_actions_pkey PRIMARY KEY (id),
    CONSTRAINT common_available_actions_pk UNIQUE (class)
);
