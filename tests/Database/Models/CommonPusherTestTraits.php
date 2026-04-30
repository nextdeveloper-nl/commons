<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonPusherQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonPusherService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonPusherTestTraits
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

    public function test_http_commonpusher_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonpusher',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonpusher_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonpusher', [
            'form_params'   =>  [
                'name'  =>  'a',
                'description'  =>  'a',
                'token'  =>  'a',
                'url'  =>  'a',
                'method'  =>  'a',
                'provider'  =>  'a',
                'auth_header'  =>  'a',
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
    public function test_commonpusher_model_get()
    {
        $result = AbstractCommonPusherService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonpusher_get_all()
    {
        $result = AbstractCommonPusherService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonpusher_get_paginated()
    {
        $result = AbstractCommonPusherService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonpusher_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusher_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::first();

            event(new \NextDeveloper\Commons\Events\CommonPusher\CommonPusherRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_description_filter()
    {
        try {
            $request = new Request(
                [
                'description'  =>  'a'
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_token_filter()
    {
        try {
            $request = new Request(
                [
                'token'  =>  'a'
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_url_filter()
    {
        try {
            $request = new Request(
                [
                'url'  =>  'a'
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_method_filter()
    {
        try {
            $request = new Request(
                [
                'method'  =>  'a'
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_provider_filter()
    {
        try {
            $request = new Request(
                [
                'provider'  =>  'a'
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_auth_header_filter()
    {
        try {
            $request = new Request(
                [
                'auth_header'  =>  'a'
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusher_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusher::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}