<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\RegistryQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractRegistryService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait RegistryTestTraits
{
    public $http;

    /**
    *   Creating the Guzzle object
    */
    public function setupGuzzle()
    {
        $this->http = new Client([
            'base_uri'  =>  '127.0.0.1:8000'
        ]);
    }

    /**
    *   Destroying the Guzzle object
    */
    public function destroyGuzzle()
    {
        $this->http = null;
    }

    public function test_http_registry_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/registry',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_registry_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/registry', [
            'form_params'   =>  [
                'key'  =>  'a',
                'value'  =>  'a',
                ],
                ['http_errors' => false]
            ]
        );

        $this->assertEquals($response->getStatusCode(), Response::HTTP_OK);
    }

    /**
    * Get test
    *
    * @return bool
    */
    public function test_registry_model_get()
    {
        $result = AbstractRegistryService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_registry_get_all()
    {
        $result = AbstractRegistryService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_registry_get_paginated()
    {
        $result = AbstractRegistryService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_registry_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistryRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistryCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistryCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistrySavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistrySavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistryUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistryUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistryDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistryDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistryRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Registry\RegistryRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_registry_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistryRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistryCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistryCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistrySavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistrySavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistryUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistryUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistryDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistryDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistryRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_registry_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Registry::first();

            event( new \NextDeveloper\Commons\Events\Registry\RegistryRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_registry_event_key_filter()
    {
        try {
            $request = new Request([
                'key'  =>  'a'
            ]);

            $filter = new RegistryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Registry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_registry_event_value_filter()
    {
        try {
            $request = new Request([
                'value'  =>  'a'
            ]);

            $filter = new RegistryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Registry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}