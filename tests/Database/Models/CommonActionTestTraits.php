<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CommonActionQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonActionService;
use Tests\TestCase;

trait CommonActionTestTraits
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

    public function test_http_commonaction_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonaction',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonaction_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonaction', [
            'form_params'   =>  [
                'action'  =>  'a',
                'object_type'  =>  'a',
                'progress'  =>  '1',
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
    public function test_commonaction_model_get()
    {
        $result = AbstractCommonActionService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonaction_get_all()
    {
        $result = AbstractCommonActionService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonaction_get_paginated()
    {
        $result = AbstractCommonActionService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonaction_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaction_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAction\CommonActionRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_action_filter()
    {
        try {
            $request = new Request(
                [
                'action'  =>  'a'
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_object_type_filter()
    {
        try {
            $request = new Request(
                [
                'object_type'  =>  'a'
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_progress_filter()
    {
        try {
            $request = new Request(
                [
                'progress'  =>  '1'
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_runtime_filter()
    {
        try {
            $request = new Request(
                [
                'runtime'  =>  '1'
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaction_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}