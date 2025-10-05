<?php

namespace NextDeveloper\Commons\Authorization\Roles;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
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
        $isActiveExists = DatabaseHelper::isColumnExists($model->getTable(), 'is_active');

        // TODO: Implement apply() method.
        $isAccountIdExists = DatabaseHelper::isColumnExists($model->getTable(), 'iam_account_id');
        $isUserIdExists =  DatabaseHelper::isColumnExists($model->getTable(), 'iam_user_id');

        $where = [];

        if($isAccountIdExists) {
            $where[] = ['iam_account_id', UserHelper::currentAccount()->id];
            $builder->where('iam_account_id', UserHelper::currentAccount()->id);
        }

        if($isUserIdExists) {
            $where[] = ['iam_user_id', UserHelper::me()->id];
            $builder->where('iam_user_id', UserHelper::me()->id);
        }

        //  We need to change this in the future because in the future if we try to implement NON-HTTP request, this will not work.
        if(request()->getMethod() == 'GET') {
            if($isPublicExists) {
                $builder->where('is_public', true)
                    ->orWhere($where);
            }
        }

        $builder->where($where);
    }

    public function checkPrivileges(Users $users = null, Model $model)
    {
        $operation = $model->getTable();

        switch (request()->getMethod()) {
            case 'GET':
                $operation .= ':read';
            case 'POST':
                $operation .= ':create';
            case 'PUT':
            case 'PATCH':
            $operation .= ':update';
            case 'DELETE':
                $operation .= ':delete';
        }

        if(in_array($operation, $this->allowedOperations())) {
            return true;
        }

        return false;
    }

    public function getModule()
    {
        return 'commons';
    }


    public function allowedOperations() :array
    {
        return [
            'common_available_actions:read',

            'common_action_logs:read',
            'common_action_logs:create',
            'common_action_logs:update',
            'common_actions:read',
            'common_actions:create',
            'common_actions:update',

            'common_addresses:read',
            'common_addresses:create',
            'common_addresses:update',
            'common_addresses:delete',

            'common_categories:read',

            'common_cities:read',

            'common_comments:read',
            'common_comments:create',
            'common_comments:update',
            'common_comments:delete',

            'common_countries:read',

            'common_country_states:read',

            'common_currencies:read',

            'common_disposable_emails:read',
            'common_keywords:read',
            'common_keywords:create',
            'common_keywords:update',
            'common_keywords:delete',
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
            '!common_states:create',
            '!common_states:update',
            'common_tags:read',
            '!common_tags:create',
            '!common_tags:update',
            'common_validatable:read',
            'common_validatable:create',
            'common_validatable:update',
            'common_votes:read',
            'common_votes:create',
            'common_votes:update',
            'common_external_services:create',
            'common_external_services:update',
            'common_external_services:delete',
            'common_external_services:read',

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
