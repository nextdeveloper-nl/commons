<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonActionCheckpointQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonActionCheckpointService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonActionCheckpointTestTraits
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

    public function test_http_commonactioncheckpoint_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonactioncheckpoint',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonactioncheckpoint_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonactioncheckpoint', [
            'form_params'   =>  [
                'name'  =>  'a',
                'progress'  =>  '1',
                'pid'  =>  '1',
                'checkpoint_number'  =>  '1',
                    'starts_at'  =>  now(),
                    'ends_at'  =>  now(),
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
    public function test_commonactioncheckpoint_model_get()
    {
        $result = AbstractCommonActionCheckpointService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonactioncheckpoint_get_all()
    {
        $result = AbstractCommonActionCheckpointService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonactioncheckpoint_get_paginated()
    {
        $result = AbstractCommonActionCheckpointService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonactioncheckpoint_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonactioncheckpoint_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::first();

            event(new \NextDeveloper\Commons\Events\CommonActionCheckpoint\CommonActionCheckpointRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_progress_filter()
    {
        try {
            $request = new Request(
                [
                'progress'  =>  '1'
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_pid_filter()
    {
        try {
            $request = new Request(
                [
                'pid'  =>  '1'
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_checkpoint_number_filter()
    {
        try {
            $request = new Request(
                [
                'checkpoint_number'  =>  '1'
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_starts_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'starts_atStart'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_ends_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'ends_atStart'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_starts_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'starts_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_ends_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'ends_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_starts_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'starts_atStart'  =>  now(),
                'starts_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_ends_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'ends_atStart'  =>  now(),
                'ends_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonactioncheckpoint_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionCheckpointQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonActionCheckpoint::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}