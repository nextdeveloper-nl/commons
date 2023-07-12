<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\ExchangeRateQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractExchangeRateService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait ExchangeRateTestTraits
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

    public function test_http_exchangerate_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/exchangerate',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_exchangerate_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/exchangerate', [
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
    public function test_exchangerate_model_get()
    {
        $result = AbstractExchangeRateService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_exchangerate_get_all()
    {
        $result = AbstractExchangeRateService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_exchangerate_get_paginated()
    {
        $result = AbstractExchangeRateService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_exchangerate_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_exchangerate_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::first();

            event( new \NextDeveloper\Commons\Events\ExchangeRate\ExchangeRateRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_rate_filter()
    {
        try {
            $request = new Request([
                'rate'  =>  '1'
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_last_modified_filter_start()
    {
        try {
            $request = new Request([
                'last_modifiedStart'  =>  now()
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_last_modified_filter_end()
    {
        try {
            $request = new Request([
                'last_modifiedEnd'  =>  now()
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_last_modified_filter_start_and_end()
    {
        try {
            $request = new Request([
                'last_modifiedStart'  =>  now(),
                'last_modifiedEnd'  =>  now()
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_exchangerate_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new ExchangeRateQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\ExchangeRate::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}