<?php

namespace NextDeveloper\Commons\Authorization\Roles;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use NextDeveloper\CRM\Database\Models\AccountManagers;
use NextDeveloper\IAM\Authorization\Roles\AbstractRole;
use NextDeveloper\IAM\Authorization\Roles\IAuthorizationRole;
use NextDeveloper\IAM\Database\Models\Users;
use NextDeveloper\IAM\Helpers\UserHelper;

class CommonsAdminRole extends AbstractRole implements IAuthorizationRole
{
    public const NAME = 'commons-admin';

    public const LEVEL = 100;

    public const DESCRIPTION = 'Commons Admin';

    public const DB_PREFIX = 'commons';

    /**
     * Applies basic member role sql for Eloquent
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        /**
         * Here user will be able to list all models, because by default, sales manager can see everybody.
         */
        $ids = AccountManagers::withoutGlobalScopes()
            ->where('iam_account_id', UserHelper::currentAccount()->id)
            ->pluck('crm_account_id');

        $builder->whereIn('iam_account_id', $ids);
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
            'common_addresses:read',
            'common_addresses:create',
            'common_addresses:update',
            'common_categories:read',
            'common_categories:create',
            'common_categories:update',
            'common_cities:read',
            'common_cities:create',
            'common_cities:update',
            'common_comments:read',
            'common_comments:create',
            'common_comments:update',
            'common_comments:delete',
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
}
