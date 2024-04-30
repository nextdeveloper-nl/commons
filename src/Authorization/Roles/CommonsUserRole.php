<?php

namespace NextDeveloper\Commons\Authorization\Roles;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\CRM\Database\Models\AccountManagers;
use NextDeveloper\IAM\Authorization\Roles\AbstractRole;
use NextDeveloper\IAM\Authorization\Roles\IAuthorizationRole;
use NextDeveloper\IAM\Database\Models\Users;
use NextDeveloper\IAM\Helpers\UserHelper;

class CommonsUserRole extends AbstractRole implements IAuthorizationRole
{
    public const NAME = 'commons-user';

    public const LEVEL = 150;

    public const DESCRIPTION = 'Commons User';

    public const DB_PREFIX = 'common';

    /**
     * Applies basic member role sql for Eloquent
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $isPublicExists = DatabaseHelper::isColumnExists($model->getTable(), 'is_public');

        // TODO: Implement apply() method.
        $isAccountIdExists = DatabaseHelper::isColumnExists($model->getTable(), 'iam_account_id');
        $isUserIdExists =  DatabaseHelper::isColumnExists($model->getTable(), 'iam_user_id');

        $where = [];

        if($isAccountIdExists) {
            Log::info('[MemberRole] Applying iam_account_id');
            $where[] = ['iam_account_id', UserHelper::currentAccount()->id];
            $builder->where('iam_account_id', UserHelper::currentAccount()->id);
        }

        if($isUserIdExists) {
            Log::info('[MemberRole] Applying iam_user_id');
            $where[] = ['iam_user_id', UserHelper::me()->id];
            $builder->where('iam_user_id', UserHelper::me()->id);
        }

        if($isPublicExists) {
            Log::info('[MemberRole] Applying is_public = true and user model');
            $builder->where('is_public', true)
                ->orWhere($where);
        } else {
            $builder->where($where);
        }
    }

    public function checkPrivileges(Users $users = null)
    {
        //return UserHelper::hasRole(self::NAME, $users);
    }

    public function getModule()
    {
        return 'commons';
    }

    public function allowedOperations() :array
    {
        return [
            'common_action_logs:read',
            'common_actions:read',
            'common_actions:create',
            'common_addresses:read',
            'common_categories:read',
            'common_cities:read',
            'common_comments:read',
            'common_countries:read',
            'common_country_states:read',
            'common_currencies:read',
            'common_disposable_emails:read',
            'common_domains:read',
            'common_domains:create',
            'common_domains:delete',
            'common_exchange_rates:read',
            'common_languages:read',
            'common_media:read',
            'common_media:create',
            'common_media:update',
            'common_media:delete',
            'common_meta:read',
            'common_phone_numbers:read',
            'common_phone_numbers:create',
            'common_phone_numbers:update',
            'common_phone_numbers:delete',
            'common_registries:read',
            'common_social_media:read',
            'common_social_media:create',
            'common_social_media:update',
            'common_social_media:delete',
            'common_states:read',
            'common_tags:read',
            'common_validatable:read',
            'common_votes:read'
        ];
    }

    public function getLevel(): int
    {
        return self::LEVEL;
    }

    public function getDescription(): string
    {
        return self::DESCRIPTION;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function canBeApplied($column)
    {
        if(self::DB_PREFIX === '*') {
            return true;
        }

        if(Str::startsWith($column, self::DB_PREFIX)) {
            return true;
        }

        return false;
    }

    public function getDbPrefix()
    {
        return self::DB_PREFIX;
    }

    public function checkRules(Users $users): bool
    {
        // TODO: Implement checkRules() method.
    }
}
