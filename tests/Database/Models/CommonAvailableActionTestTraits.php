<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonAvailableActionQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonAvailableActionService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonAvailableActionTestTraits
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

    public function test_http_commonavailableaction_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonavailableaction',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonavailableaction_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonavailableaction', [
            'form_params'   =>  [
                'action'  =>  'a',
                'description'  =>  'a',
                'class'  =>  'a',
                'input'  =>  'a',
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
    public function test_commonavailableaction_model_get()
    {
        $result = AbstractCommonAvailableActionService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonavailableaction_get_all()
    {
        $result = AbstractCommonAvailableActionService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonavailableaction_get_paginated()
    {
        $result = AbstractCommonAvailableActionService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonavailableaction_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonavailableaction_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::first();

            event(new \NextDeveloper\Commons\Events\CommonAvailableAction\CommonAvailableActionRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_action_filter()
    {
        try {
            $request = new Request(
                [
                'action'  =>  'a'
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_description_filter()
    {
        try {
            $request = new Request(
                [
                'description'  =>  'a'
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_class_filter()
    {
        try {
            $request = new Request(
                [
                'class'  =>  'a'
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_input_filter()
    {
        try {
            $request = new Request(
                [
                'input'  =>  'a'
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonavailableaction_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonAvailableActionQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAvailableAction::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}