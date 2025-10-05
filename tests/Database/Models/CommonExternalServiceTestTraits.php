<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CommonExternalServiceQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonExternalServiceService;
use Tests\TestCase;

trait CommonExternalServiceTestTraits
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

    public function test_http_commonexternalservice_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonexternalservice',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonexternalservice_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonexternalservice', [
            'form_params'   =>  [
                'code'  =>  'a',
                'name'  =>  'a',
                'description'  =>  'a',
                'token'  =>  'a',
                'refresh_token'  =>  'a',
                'service_owner'  =>  'a',
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
    public function test_commonexternalservice_model_get()
    {
        $result = AbstractCommonExternalServiceService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonexternalservice_get_all()
    {
        $result = AbstractCommonExternalServiceService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonexternalservice_get_paginated()
    {
        $result = AbstractCommonExternalServiceService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonexternalservice_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexternalservice_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::first();

            event(new \NextDeveloper\Commons\Events\CommonExternalService\CommonExternalServiceRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_code_filter()
    {
        try {
            $request = new Request(
                [
                'code'  =>  'a'
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_description_filter()
    {
        try {
            $request = new Request(
                [
                'description'  =>  'a'
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_token_filter()
    {
        try {
            $request = new Request(
                [
                'token'  =>  'a'
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_refresh_token_filter()
    {
        try {
            $request = new Request(
                [
                'refresh_token'  =>  'a'
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_service_owner_filter()
    {
        try {
            $request = new Request(
                [
                'service_owner'  =>  'a'
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexternalservice_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonExternalServiceQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExternalService::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}