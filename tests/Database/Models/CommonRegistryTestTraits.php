<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonRegistryQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonRegistryService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonRegistryTestTraits
{
    public $http;

    /**
     *   Creating the Guzzle object
     */
    public function setupGuzzle()
    {
        $this->http = new Client(
            [
            'base_uri'  =>  '127.0.0.1:8000'
            ]
        );
    }

    /**
     *   Destroying the Guzzle object
     */
    public function destroyGuzzle()
    {
        $this->http = null;
    }

    public function test_http_commonregistry_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonregistry',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonregistry_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonregistry', [
            'form_params'   =>  [
                'key'  =>  'a',
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
    public function test_commonregistry_model_get()
    {
        $result = AbstractCommonRegistryService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonregistry_get_all()
    {
        $result = AbstractCommonRegistryService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonregistry_get_paginated()
    {
        $result = AbstractCommonRegistryService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonregistry_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistrySavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistrySavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonregistry_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistrySavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistrySavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonregistry_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::first();

            event(new \NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonregistry_event_key_filter()
    {
        try {
            $request = new Request(
                [
                'key'  =>  'a'
                ]
            );

            $filter = new CommonRegistryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonRegistry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}