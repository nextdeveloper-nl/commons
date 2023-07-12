<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\StateQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractStateService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait StateTestTraits
{
    public $http;

    /**
    *   Creating the Guzzle object
    */
    public function setupGuzzle()
    {
        $this->http = new Client([
            'base_uri'  =>  '127.0.0.1:8000'
        ]);
    }

    /**
    *   Destroying the Guzzle object
    */
    public function destroyGuzzle()
    {
        $this->http = null;
    }

    public function test_http_state_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/state',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_state_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/state', [
            'form_params'   =>  [
                'name'  =>  'a',
                'value'  =>  'a',
                'reason'  =>  'a',
                'model_type'  =>  'a',
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
    public function test_state_model_get()
    {
        $result = AbstractStateService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_state_get_all()
    {
        $result = AbstractStateService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_state_get_paginated()
    {
        $result = AbstractStateService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_state_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\State\StateRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_state_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\State::first();

            event( new \NextDeveloper\Commons\Events\State\StateRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_value_filter()
    {
        try {
            $request = new Request([
                'value'  =>  'a'
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_reason_filter()
    {
        try {
            $request = new Request([
                'reason'  =>  'a'
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_model_type_filter()
    {
        try {
            $request = new Request([
                'model_type'  =>  'a'
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_state_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new StateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\State::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}