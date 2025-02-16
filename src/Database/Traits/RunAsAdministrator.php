<?php
/**
 * This file was part of the PlusClouds.Core library but now its migrated to
 * NextDeveloper.Commons
 *
 * (c) Semih Turna <semih.turna@plusclouds.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NextDeveloper\Commons\Database\Traits;

use App\Helpers\ObjectHelper;
use NextDeveloper\Events\Services\Events;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
 * Trait HasStates
 * @package  NextDeveloper\Commons\Database\Traits
 */
trait RunAsAdministrator
{
    public static function createAsAdministrator($data) {
        $user = UserHelper::getLeoOwner();
        $account = UserHelper::getLeoOwnerAccount();

        $data['iam_user_id'] = $user->id;
        $data['iam_account_id'] = $account->id;

        UserHelper::setAdminAsCurrentUser();

        $obj = self::withoutEvents(function () use ($data) {
            $obj = self::create($data);
            Events::fire('created:' . ObjectHelper::getPublicObjectName($this) , $obj);
            return $obj;
        });

        UserHelper::setCurrentUserAndAccount($user, $account);

        return $obj;
    }
}
