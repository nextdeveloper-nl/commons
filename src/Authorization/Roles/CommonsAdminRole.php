<?php

namespace NextDeveloper\Commons\Authorization\Roles;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Authorization\Roles\AbstractRole;
use NextDeveloper\IAM\Authorization\Roles\IAuthorizationRole;
use NextDeveloper\IAM\Database\Models\Users;

class CommonsAdminRole extends AbstractRole implements IAuthorizationRole
{
    public const NAME = 'commons-admin';

    public const LEVEL = 100;

    public const DESCRIPTION = 'Commons Admin';

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
        //  Returns everything about commons
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
            'common_action_logs:create',
            'common_action_logs:update',
            'common_actions:read',
            'common_actions:create',
            'common_actions:update',
            'common_addresses:read',
            'common_addresses:create',
            'common_addresses:update',
            'common_categories:read',
            'common_categories:create',
            'common_categories:update',
            'common_exchange_rates:read',
            'common_exchange_rates:create',
            'common_exchange_rates:update',
            'common_exchange_rates:delete',
            'common_external_services:read',
            'common_external_services:create',
            'common_external_services:update',
            'common_external_services:delete',
            'common_cities:read',
            'common_cities:create',
            'common_cities:update',
            'common_comments:read',
            'common_comments:create',
            'common_comments:update',
            'common_comments:delete',
            'common_keywords:read',
            'common_keywords:create',
            'common_keywords:update',
            'common_keywords:delete',
            'common_countries:read',
            'common_country_states:read',
            'common_currencies:read',
            'common_disposable_emails:read',
            'common_domains:read',
            'common_domains:create',
            'common_domains:update',
            'common_domains:delete',
            'common_exchange_rates:read',
            'common_languages:create',
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
            //  When we have ! here, this means that dont check the policy. Just do it.
            '!common_states:create',
            '!common_states:update',
            '!common_states:delete',
            'common_tags:read',
            '!common_tags:create',
            '!common_tags:update',
            '!common_tags:delete',
            'common_validatable:read',
            '!common_validatable:create',
            '!common_validatable:update',
            'common_votes:read',
            '!common_votes:create',
            '!common_votes:update',
            '!common_votes:delete',

            'common_task_schedulers:read',
            'common_task_schedulers:create',
            'common_task_schedulers:update',
            'common_task_schedulers:delete',
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
