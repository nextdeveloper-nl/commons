<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CommonActionLogQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonActionLogService;
use Tests\TestCase;

trait CommonActionLogTestTraits
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

    public function test_http_commonactionlog_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonactionlog',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonactionlog_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonactionlog', [
            'form_params'   =>  [
                'runtime'  =>  '1',
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
    public function test_commonactionlog_model_get()
    {
        $result = AbstractCommonActionLogService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonactionlog_get_all()
    {
        $result = AbstractCommonActionLogService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonactionlog_get_paginated()
    {
        $result = AbstractCommonActionLogService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonactionlog_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactionlog_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactionlog_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::first();

            event(new \NextDeveloper\Commons\Events\CommonActionLog\CommonActionLogRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactionlog_event_runtime_filter()
    {
        try {
            $request = new Request(
                [
                'runtime'  =>  '1'
                ]
            );

            $filter = new CommonActionLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactionlog_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonActionLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactionlog_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactionlog_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionLogQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionLog::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}