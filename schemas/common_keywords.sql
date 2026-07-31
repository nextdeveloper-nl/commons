-- PostgreSQL

CREATE TABLE common_keywords (
    id    bigint NOT NULL DEFAULT nextval('common_keywords_id_seq'::regclass),
    uuid  uuid NOT NULL DEFAULT gen_random_uuid(),
    name  text NOT NULL,
    CONSTRAINT common_keywords_pkey PRIMARY KEY (id),
    CONSTRAINT common_keywords_pk UNIQUE (name)
);
