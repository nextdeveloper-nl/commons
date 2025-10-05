<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CommonTaskSchedulerQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonTaskSchedulerService;
use Tests\TestCase;

trait CommonTaskSchedulerTestTraits
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

    public function test_http_commontaskscheduler_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commontaskscheduler',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commontaskscheduler_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commontaskscheduler', [
            'form_params'   =>  [
                'name'  =>  'a',
                'description'  =>  'a',
                'schedule_type'  =>  'a',
                'object_type'  =>  'a',
                'day_of_month'  =>  '1',
                'day_of_week'  =>  '1',
                    'next_run'  =>  now(),
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
    public function test_commontaskscheduler_model_get()
    {
        $result = AbstractCommonTaskSchedulerService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commontaskscheduler_get_all()
    {
        $result = AbstractCommonTaskSchedulerService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commontaskscheduler_get_paginated()
    {
        $result = AbstractCommonTaskSchedulerService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commontaskscheduler_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaskscheduler_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::first();

            event(new \NextDeveloper\Commons\Events\CommonTaskScheduler\CommonTaskSchedulerRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_description_filter()
    {
        try {
            $request = new Request(
                [
                'description'  =>  'a'
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_schedule_type_filter()
    {
        try {
            $request = new Request(
                [
                'schedule_type'  =>  'a'
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_object_type_filter()
    {
        try {
            $request = new Request(
                [
                'object_type'  =>  'a'
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_day_of_month_filter()
    {
        try {
            $request = new Request(
                [
                'day_of_month'  =>  '1'
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_day_of_week_filter()
    {
        try {
            $request = new Request(
                [
                'day_of_week'  =>  '1'
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_next_run_filter_start()
    {
        try {
            $request = new Request(
                [
                'next_runStart'  =>  now()
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_next_run_filter_end()
    {
        try {
            $request = new Request(
                [
                'next_runEnd'  =>  now()
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_next_run_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'next_runStart'  =>  now(),
                'next_runEnd'  =>  now()
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaskscheduler_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTaskSchedulerQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaskScheduler::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}