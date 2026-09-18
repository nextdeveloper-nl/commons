<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Database\Models\Categories;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCategoriesService;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
 * This class is responsible from managing the data for Categories
 *
 * Class CategoriesService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class CategoriesService extends AbstractCategoriesService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    /**
     * A category belongs to a domain. A caller that does not name one gets the domain of the account
     * it works in, which it has no other way to look up.
     */
    public static function create(array $data)
    {
        if (!array_key_exists('common_domain_id', $data) || $data['common_domain_id'] === null) {
            $data['common_domain_id'] = UserHelper::currentAccount()?->common_domain_id;
        }

        return parent::create($data);
    }

    public static function getPublicCategories($domainUuid) {
        $domain = \NextDeveloper\Commons\Database\Models\Domains::withoutGlobalScope(AuthorizationScope::class)
            ->where('uuid', $domainUuid)
            ->first();

        $categories = Categories::withoutGlobalScope(AuthorizationScope::class)
            ->where('common_domain_id', $domain->id)
            ->get();

        return $categories;
    }
}
