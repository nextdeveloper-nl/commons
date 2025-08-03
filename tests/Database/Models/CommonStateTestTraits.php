<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CommonStateQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonStateService;

trait CommonStateTestTraits
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

    public function test_http_commonstate_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonstate',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonstate_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonstate', [
            'form_params'   =>  [
                'name'  =>  'a',
                'value'  =>  'a',
                'reason'  =>  'a',
                'object_type'  =>  'a',
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
    public function test_commonstate_model_get()
    {
        $result = AbstractCommonStateService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonstate_get_all()
    {
        $result = AbstractCommonStateService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonstate_get_paginated()
    {
        $result = AbstractCommonStateService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonstate_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonstate_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonState::first();

            event(new \NextDeveloper\Commons\Events\CommonState\CommonStateRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_value_filter()
    {
        try {
            $request = new Request(
                [
                'value'  =>  'a'
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_reason_filter()
    {
        try {
            $request = new Request(
                [
                'reason'  =>  'a'
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_object_type_filter()
    {
        try {
            $request = new Request(
                [
                'object_type'  =>  'a'
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonstate_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
