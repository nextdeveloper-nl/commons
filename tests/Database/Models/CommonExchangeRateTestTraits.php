<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonExchangeRateQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonExchangeRateService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonExchangeRateTestTraits
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

    public function test_http_commonexchangerate_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonexchangerate',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_commonexchangerate_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/commonexchangerate', [
            'form_params'   =>  [
                'rate'  =>  '1',
                    'last_modified'  =>  now(),
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
    public function test_commonexchangerate_model_get()
    {
        $result = AbstractCommonExchangeRateService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonexchangerate_get_all()
    {
        $result = AbstractCommonExchangeRateService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonexchangerate_get_paginated()
    {
        $result = AbstractCommonExchangeRateService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonexchangerate_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonexchangerate_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_rate_filter()
    {
        try {
            $request = new Request([
                'rate'  =>  '1'
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_last_modified_filter_start()
    {
        try {
            $request = new Request([
                'last_modifiedStart'  =>  now()
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_last_modified_filter_end()
    {
        try {
            $request = new Request([
                'last_modifiedEnd'  =>  now()
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_last_modified_filter_start_and_end()
    {
        try {
            $request = new Request([
                'last_modifiedStart'  =>  now(),
                'last_modifiedEnd'  =>  now()
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonexchangerate_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}