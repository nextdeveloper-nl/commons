<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use NextDeveloper\Commons\Services\AbstractServices\AbstractAccountService;

trait AccountTestTraits
{
    /**
    * Get test
    *
    * @return bool
    */
    public function test_Account_model_get()
    {
        $result = AbstractAccountService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_Account_get_all()
    {
        $result = AbstractAccountService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_Account_get_paginated()
    {
        $result = AbstractAccountService::getPaginated();

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_Account_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }
    public function test_Account_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Accounts\AccountsRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse();
        }

        $this->assertTrue(true);
    }

    public function test_Account_event_retrieved_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsRetrievedEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_created_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsCreatedEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_creating_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsCreatingEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_saving_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsSavingEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_saved_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsSavedEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_updating_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsUpdatingEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_updated_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsUpdatedEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_deleting_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsDeletingEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_deleted_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsDeletedEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_restoring_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsRestoringEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
    public function test_Account_event_restored_with_object()
    {
        try {
    $model = \NextDeveloper\Commons\Database\Models\Account::first();

    event( new \NextDeveloper\Commons\Events\Accounts\AccountsRestoredEvent($model) );
    } catch (\Exception $e) {
    $this->assertFalse();
    }

    $this->assertTrue(true);
    }
}