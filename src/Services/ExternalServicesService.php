<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Services\AbstractServices\AbstractExternalServicesService;

/**
 * This class is responsible from managing the data for ExternalServices
 *
 * Class ExternalServicesService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class ExternalServicesService extends AbstractExternalServicesService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    /**
     * This method returns the available services.
     *
     * @return array
     */
    public static function availableService(): array
    {
        return collect(config('commons.external_services'))
            ->where('status', true)
            ->all();
    }

}
