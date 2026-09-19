-- PostgreSQL
-- VIEW (read-only; re-run this file with CREATE OR REPLACE VIEW whenever the SELECT needs to change)

CREATE OR REPLACE VIEW common_scheduled_tasks_perspective AS
SELECT id,
    uuid,
    name,
    description,
    day_of_month,
    day_of_week,
    time_of_day,
    schedule_type,
    next_run_at,
    object_type,
    object_id,
    cron_expression,
    common_available_action_id,
    params,
    timezone,
    created_at,
    updated_at
   FROM common_task_schedulers
  WHERE schedule_type = 'daily'::text OR schedule_type = 'weekly'::text AND day_of_week = EXTRACT(dow FROM now())::integer OR schedule_type = 'monthly'::text AND day_of_month = EXTRACT(day FROM now())::integer;
