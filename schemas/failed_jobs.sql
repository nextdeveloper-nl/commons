-- PostgreSQL

CREATE TABLE failed_jobs (
    id          bigint NOT NULL DEFAULT nextval('failed_jobs_id_seq'::regclass),
    uuid        text NOT NULL,
    connection  text NOT NULL,
    queue       text NOT NULL,
    payload     text NOT NULL,
    exception   text NOT NULL,
    failed_at   timestamp with time zone NOT NULL DEFAULT now(),
    CONSTRAINT failed_jobs_pkey PRIMARY KEY (id),
    CONSTRAINT failed_jobs_uuid_key UNIQUE (uuid)
);
