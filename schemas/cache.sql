-- PostgreSQL
-- Unlogged key/value cache table (Laravel database cache driver). Not WAL-logged, so contents are lost on crash/restart.

CREATE UNLOGGED TABLE cache (
    key         varchar(255) NOT NULL,
    value       text NOT NULL,
    expiration  integer NOT NULL,
    CONSTRAINT cache_pkey PRIMARY KEY (key)
);

CREATE INDEX cache_expiration_idx ON public.cache USING btree (expiration);
