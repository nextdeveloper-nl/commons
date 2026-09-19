-- PostgreSQL
-- VIEW (read-only; re-run this file with CREATE OR REPLACE VIEW whenever the SELECT needs to change)

CREATE OR REPLACE VIEW common_actions_perspective AS
SELECT ca.uuid,
    ca.action,
    ca.progress,
    ca.runtime,
    ca.object_id,
    ca.object_type,
    ca.iam_user_id,
    ca.iam_account_id,
    ca.created_at,
    ca.updated_at,
    cal.uuid AS ca_uuid,
    cal.log,
    cal.runtime AS subaction_runtime
   FROM common_actions ca
     JOIN common_action_logs cal ON ca.id = cal.common_action_id
  ORDER BY cal.created_at;
