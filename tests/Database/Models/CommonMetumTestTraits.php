<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonMetumQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonMetumService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonMetumTestTraits
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

    public function test_http_commonmetum_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonmetum',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonmetum_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonmetum', [
            'form_params'   =>  [
                'object_type'  =>  'a',
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
    public function test_commonmetum_model_get()
    {
        $result = AbstractCommonMetumService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonmetum_get_all()
    {
        $result = AbstractCommonMetumService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonmetum_get_paginated()
    {
        $result = AbstractCommonMetumService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonmetum_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmetum_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmetum_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::first();

            event(new \NextDeveloper\Commons\Events\CommonMetum\CommonMetumRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmetum_event_object_type_filter()
    {
        try {
            $request = new Request(
                [
                'object_type'  =>  'a'
                ]
            );

            $filter = new CommonMetumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmetum_event_key_filter()
    {
        try {
            $request = new Request(
                [
                'key'  =>  'a'
                ]
            );

            $filter = new CommonMetumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmetum_event_value_filter()
    {
        try {
            $request = new Request(
                [
                'value'  =>  'a'
                ]
            );

            $filter = new CommonMetumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMetum::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}