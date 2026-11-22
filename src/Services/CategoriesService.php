<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Database\Models\Categories;
use NextDeveloper\Commons\Exceptions\NotAllowedException;
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
     *
     * Categories are tenant owned: the owner account and user always come from the session (never from the
     * request) and a category is private unless the caller explicitly marks it public.
     */
    public static function create(array $data)
    {
        if (!array_key_exists('common_domain_id', $data) || $data['common_domain_id'] === null) {
            $data['common_domain_id'] = UserHelper::currentAccount()?->common_domain_id;
        }

        // Ownership comes from the session; anything the client sent for these is overwritten.
        $data['iam_account_id'] = UserHelper::currentAccount()->id;
        $data['iam_user_id'] = UserHelper::me()->id;

        // Private by default; only an explicit true makes it visible to every account.
        $data['is_public'] = (bool) ($data['is_public'] ?? false);

        self::assertParentUsable($data['common_category_id'] ?? null);

        return parent::create($data);
    }

    /**
     * Owner columns can never be changed through an update. The visibility scope on CommonsUserRole already
     * hides other accounts' categories (and system categories) from the lookup, so a foreign category ends
     * up as "cannot find the related object" in the abstract service.
     */
    public static function update($id, array $data)
    {
        // Ownership is immutable; ignore whatever the client sent.
        unset($data['iam_account_id'], $data['iam_user_id']);

        if (array_key_exists('is_public', $data)) {
            $data['is_public'] = (bool) $data['is_public'];
        }

        self::assertParentUsable($data['common_category_id'] ?? null, $id);

        return parent::update($id, $data);
    }

    /**
     * A category in use (child categories, marketplace products) cannot be deleted; otherwise the
     * owner would silently orphan data.
     */
    public static function delete($id)
    {
        $model = Categories::where('uuid', $id)->first();

        if ($model) {
            if (Categories::where('common_category_id', $model->id)->exists()) {
                throw new NotAllowedException('This category has sub categories. Please remove them first.');
            }

            $productsClass = '\NextDeveloper\Marketplace\Database\Models\Products';

            if (class_exists($productsClass)
                && $productsClass::withoutGlobalScopes()->where('common_category_id', $model->id)->exists()) {
                throw new NotAllowedException('This category is used by products. Please move the products first.');
            }
        }

        return parent::delete($id);
    }

    /**
     * Makes sure a parent category exists in the caller's visible set (public or own), so a tenant cannot
     * hang its category under another tenant's private one. Also prevents a category being its own parent.
     */
    private static function assertParentUsable(?string $parentUuid, ?string $selfUuid = null): void
    {
        if (!$parentUuid) {
            return;
        }

        if ($selfUuid && $parentUuid === $selfUuid) {
            throw new NotAllowedException('A category cannot be its own parent.');
        }

        // Goes through AuthorizationScope on purpose: invisible categories are not found.
        if (!Categories::where('uuid', $parentUuid)->exists()) {
            throw new NotAllowedException('The parent category cannot be found or you are not allowed to use it.');
        }
    }

    public static function getPublicCategories($domainUuid) {
        $domain = \NextDeveloper\Commons\Database\Models\Domains::withoutGlobalScope(AuthorizationScope::class)
            ->where('uuid', $domainUuid)
            ->first();

        $categories = Categories::withoutGlobalScope(AuthorizationScope::class)
            ->where('common_domain_id', $domain->id)
            // Private (tenant) categories must never leak through the public listing.
            ->where('is_public', true)
            ->get();

        return $categories;
    }
}
