<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Services\AbstractServices\AbstractExternalServicesService;
use NextDeveloper\IAM\Helpers\UserHelper;

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

    public static function createGoogleLogin($googleUser)
    {
        $user = UserHelper::getWithEmail($googleUser->email);

        return ExternalServicesService::create([
            'object_id' => $user->id,
            'object_type' => get_class($user),
            'name'  =>  'Google Login',
            'code'  =>  'google_login',
            'configuration' =>  $googleUser,
            'token' =>  $googleUser->token,
            'refresh_token' =>  $googleUser->refreshToken,
            'service_owner' =>  $user->email,
            'iam_user_id'   =>  $user->id,
            'iam_account_id' =>  UserHelper::masterAccount($user),
        ]);
    }
}
