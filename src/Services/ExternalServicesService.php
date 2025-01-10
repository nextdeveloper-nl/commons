<?php

namespace NextDeveloper\Commons\Services;

use App\Helpers\Http\ResponseHelper;
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

    public static function availableService()
    {
        return config('commons.external_services');
    }

}