-- PostgreSQL

CREATE TABLE common_task_schedulers (
    id                          bigint NOT NULL DEFAULT nextval('common_task_schedulers_id_seq'::regclass),
    uuid                        uuid DEFAULT gen_random_uuid(),
    name                        text,
    description                 text,
    day_of_month                integer,
    day_of_week                 integer,
    time_of_day                 time with time zone,
    schedule_type               text NOT NULL DEFAULT 'weekly'::text,
    next_run_at                 timestamp with time zone,
    object_type                 text,
    object_id                   bigint,
    cron_expression             text,
    common_available_action_id  bigint,
    params                      json,
    timezone                    text,
    created_at                  timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at                  timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at                  timestamp without time zone,
    CONSTRAINT common_task_schedulers_day_of_month_check CHECK (((day_of_month >= 1) AND (day_of_month <= 31))),
    CONSTRAINT common_task_schedulers_day_of_week_check CHECK (((day_of_week >= 0) AND (day_of_week <= 6))),
    CONSTRAINT common_task_schedulers_pkey PRIMARY KEY (id)
);
