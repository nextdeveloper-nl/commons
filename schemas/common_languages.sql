-- PostgreSQL

CREATE TABLE common_languages (
    id               bigint NOT NULL DEFAULT nextval('common_languages_id_seq'::regclass),
    uuid             uuid DEFAULT gen_random_uuid(), -- [ro]
    iso_639_1_code   character(2),
    iso_639_2_code   character(3),
    iso_639_2b_code  character(3),
    code             character(3) DEFAULT iso_639_1_code,
    code_v2          character(3) DEFAULT iso_639_1_code,
    code_v2b         character(3) DEFAULT iso_639_2b_code,
    name             text NOT NULL,
    native_name      text,
    is_default       boolean NOT NULL DEFAULT false,
    is_active        boolean NOT NULL DEFAULT false,
    CONSTRAINT common_languages_pkey PRIMARY KEY (id)
);
