-- PostgreSQL
-- Custom enum types shared by Commons tables (reconstructed from
-- database.leo.v4/PostgreSQL/InitialData/Create Custom Types.sql, limited to the
-- type actually referenced by a Commons table schema: common_states.object_states).

DO $$ BEGIN
    CREATE TYPE object_states AS ENUM ('info', 'warn', 'error', 'fatal', 'success', 'danger');
EXCEPTION
    WHEN duplicate_object THEN NULL;
END $$;
