<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonPusherLogQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonPusherLogService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonPusherLogTestTraits
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

    public function test_http_commonpusherlog_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonpusherlog',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonpusherlog_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonpusherlog', [
            'form_params'   =>  [
                'status'  =>  'a',
                'object_type'  =>  'a',
                'response_code'  =>  '1',
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
    public function test_commonpusherlog_model_get()
    {
        $result = AbstractCommonPusherLogService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonpusherlog_get_all()
    {
        $result = AbstractCommonPusherLogService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonpusherlog_get_paginated()
    {
        $result = AbstractCommonPusherLogService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonpusherlog_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonpusherlog_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::first();

            event(new \NextDeveloper\Commons\Events\CommonPusherLog\CommonPusherLogRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_status_filter()
    {
        try {
            $request = new Request(
                [
                'status'  =>  'a'
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_object_type_filter()
    {
        try {
            $request = new Request(
                [
                'object_type'  =>  'a'
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_response_code_filter()
    {
        try {
            $request = new Request(
                [
                'response_code'  =>  '1'
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonpusherlog_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPusherLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPusherLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}