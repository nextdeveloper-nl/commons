-- PostgreSQL
-- Unlogged lock table backing Laravel's cache-based atomic locks. Not WAL-logged, so contents are lost on crash/restart.

CREATE UNLOGGED TABLE cache_locks (
    key         varchar(255) NOT NULL,
    owner       varchar(255) NOT NULL,
    expiration  integer NOT NULL,
    CONSTRAINT cache_locks_pkey PRIMARY KEY (key)
);

CREATE INDEX cache_locks_expiration_idx ON public.cache_locks USING btree (expiration);
