<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Database\Models\Categories;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCategoriesService;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;

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
