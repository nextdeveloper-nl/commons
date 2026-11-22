<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use NextDeveloper\Commons\Authorization\Roles\CommonsAdminRole;
use NextDeveloper\Commons\Authorization\Roles\CommonsUserRole;
use NextDeveloper\Commons\Database\Models\Categories;
use NextDeveloper\Commons\Exceptions\NotAllowedException;
use NextDeveloper\Commons\Http\Requests\Categories\CategoriesCreateRequest;
use NextDeveloper\Commons\Http\Requests\Categories\CategoriesUpdateRequest;
use NextDeveloper\Commons\Services\CategoriesService;
use PHPUnit\Framework\TestCase;

/**
 * Tenant-owned (public / private) categories. These tests need no database: they pin the structural
 * contract (model, request rules, role permissions) and the guards that fire before any query.
 */
class CategoryTenantTest extends TestCase
{
    public function test_model_knows_owner_and_visibility_columns(): void
    {
        // Not instantiated through the constructor: booting the model needs the Laravel container.
        $model = (new \ReflectionClass(Categories::class))->newInstanceWithoutConstructor();

        foreach (['iam_account_id', 'iam_user_id', 'is_public'] as $column) {
            $this->assertContains($column, $model->getFillable());
        }

        $casts = (function () {
            return $this->casts;
        })->call($model);
        $this->assertSame('boolean', $casts['is_public']);
        $this->assertSame('integer', $casts['iam_account_id']);
        $this->assertSame('integer', $casts['iam_user_id']);
    }

    public function test_requests_accept_visibility_but_never_owner_columns(): void
    {
        foreach ([new CategoriesCreateRequest(), new CategoriesUpdateRequest()] as $request) {
            $rules = $request->rules();

            $this->assertArrayHasKey('is_public', $rules);
            $this->assertArrayNotHasKey('iam_account_id', $rules);
            $this->assertArrayNotHasKey('iam_user_id', $rules);
        }
    }

    public function test_user_role_can_crud_categories(): void
    {
        $operations = (new CommonsUserRole())->allowedOperations();

        foreach (['read', 'create', 'update', 'delete'] as $op) {
            $this->assertContains("common_categories:$op", $operations);
        }
    }

    public function test_admin_role_can_delete_categories(): void
    {
        $this->assertContains('common_categories:delete', (new CommonsAdminRole())->allowedOperations());
    }

    public function test_category_cannot_be_its_own_parent(): void
    {
        $uuid = '11111111-1111-4111-8111-111111111111';

        $method = new \ReflectionMethod(CategoriesService::class, 'assertParentUsable');
        $method->setAccessible(true);

        $this->expectException(NotAllowedException::class);
        $method->invoke(null, $uuid, $uuid);
    }

    public function test_no_parent_needs_no_check(): void
    {
        $method = new \ReflectionMethod(CategoriesService::class, 'assertParentUsable');
        $method->setAccessible(true);

        // null parent returns before touching the database
        $this->assertNull($method->invoke(null, null));
    }
}
