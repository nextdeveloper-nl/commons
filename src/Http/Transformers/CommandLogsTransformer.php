<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\CommandLogs;
use NextDeveloper\IAM\Database\Models\Users;

/**
 * Output of the command history. Public ids are uuids: the user is given as iam_user_id (uuid), never the integer id.
 */
class CommandLogsTransformer extends AbstractTransformer
{
    public function transform(CommandLogs $model)
    {
        $user = $model->iam_user_id ? Users::withoutGlobalScopes()->where('id', $model->iam_user_id)->first() : null;

        return $this->buildPayload([
            'id' => $model->uuid,
            'iam_user_id' => $user?->uuid,
            'user_name' => $user?->name,
            'module' => $model->module,
            'resource' => $model->resource,
            'operation' => $model->operation,
            'action' => $model->action,
            'object_type' => $model->object_type,
            'object_id' => $model->object_id,
            'source' => $model->source,
            'http_method' => $model->http_method,
            'path' => $model->path,
            'request_id' => $model->request_id,
            'ip_address' => $model->ip_address,
            'request' => $model->request,
            'context' => $model->context,
            'status' => $model->status,
            'http_status' => $model->http_status,
            'error' => $model->error,
            'created_at' => $model->created_at?->toIso8601String(),
        ]);
    }
}
