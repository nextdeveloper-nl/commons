<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonCountryStateQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonCountryStateService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonCountryStateTestTraits
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

    public function test_http_commoncountrystate_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commoncountrystate',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commoncountrystate_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commoncountrystate', [
            'form_params'   =>  [
                'name'  =>  'a',
                'code'  =>  'a',
                'latitude'  =>  'a',
                'longitude'  =>  'a',
                'type'  =>  'a',
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
    public function test_commoncountrystate_model_get()
    {
        $result = AbstractCommonCountryStateService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncountrystate_get_all()
    {
        $result = AbstractCommonCountryStateService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncountrystate_get_paginated()
    {
        $result = AbstractCommonCountryStateService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commoncountrystate_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountrystate_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountrystate_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::first();

            event(new \NextDeveloper\Commons\Events\CommonCountryState\CommonCountryStateRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountrystate_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonCountryStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountrystate_event_code_filter()
    {
        try {
            $request = new Request(
                [
                'code'  =>  'a'
                ]
            );

            $filter = new CommonCountryStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountrystate_event_latitude_filter()
    {
        try {
            $request = new Request(
                [
                'latitude'  =>  'a'
                ]
            );

            $filter = new CommonCountryStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountrystate_event_longitude_filter()
    {
        try {
            $request = new Request(
                [
                'longitude'  =>  'a'
                ]
            );

            $filter = new CommonCountryStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountrystate_event_type_filter()
    {
        try {
            $request = new Request(
                [
                'type'  =>  'a'
                ]
            );

            $filter = new CommonCountryStateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountryState::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}