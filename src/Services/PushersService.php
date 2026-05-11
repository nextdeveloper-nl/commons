<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Services\AbstractServices\AbstractPushersService;

/**
 * This class is responsible from managing the data for Pushers
 *
 * Class PushersService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class PushersService extends AbstractPushersService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    public static function create(array $data)
    {
        $data = self::resolveBaseUrl($data);

        return parent::create($data);
    }

    public static function update($id, array $data)
    {
        $data = self::resolveBaseUrl($data);

        return parent::update($id, $data);
    }

    // If provider_metadata contains {{base_url}} and a workflow_id, look up the
    // workflow in ipaas_workflows, fetch its provider, and substitute the real base_url.
    // Uses class_exists so commons stays decoupled from ipaas.
    private static function resolveBaseUrl(array $data): array
    {
        $metadata = $data['provider_metadata'] ?? null;

        if (!is_array($metadata)) {
            return $data;
        }

        $encoded = json_encode($metadata);

        if (!str_contains($encoded, '{{base_url}}')) {
            return $data;
        }

        $workflowId = $metadata['workflow_id'] ?? null;

        if (!$workflowId) {
            return $data;
        }

        $workflowClass  = '\NextDeveloper\IPAAS\Database\Models\Workflows';
        $providerClass  = '\NextDeveloper\IPAAS\Database\Models\Providers';

        if (!class_exists($workflowClass) || !class_exists($providerClass)) {
            return $data;
        }

        $workflow = $workflowClass::where('uuid', $workflowId)->first();

        if (!$workflow) {
            return $data;
        }

        $provider = $providerClass::where('id', $workflow->ipaas_provider_id)->first();

        if (!$provider || !$provider->base_url) {
            return $data;
        }

        $baseUrl  = rtrim($provider->base_url, '/');
        $resolved = json_decode(str_replace('{{base_url}}', $baseUrl, $encoded), true);

        $data['provider_metadata'] = $resolved;

        return $data;
    }
}