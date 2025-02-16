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

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use NextDeveloper\Commons\Database\Models\States;
use  NextDeveloper\Commons\Exceptions\InvalidState;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;
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

        $currentUser = UserHelper::me();
        $currentAccount = UserHelper::currentAccount();

        $data['iam_user_id'] = $user->id;
        $data['iam_account_id'] = $account->id;

        UserHelper::setAdminAsCurrentUser();
        $obj = self::create($data);
        UserHelper::setCurrentUserAndAccount($user, $account);

        return $obj;
    }
}
