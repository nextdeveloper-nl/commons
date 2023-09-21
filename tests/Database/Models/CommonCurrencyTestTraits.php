<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonCurrencyQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonCurrencyService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonCurrencyTestTraits
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

    public function test_http_commoncurrency_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commoncurrency',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commoncurrency_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commoncurrency', [
            'form_params'   =>  [
                'code'  =>  'a',
                'name'  =>  'a',
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
    public function test_commoncurrency_model_get()
    {
        $result = AbstractCommonCurrencyService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncurrency_get_all()
    {
        $result = AbstractCommonCurrencyService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncurrency_get_paginated()
    {
        $result = AbstractCommonCurrencyService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commoncurrency_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencySavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencySavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncurrency_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencySavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencySavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncurrency_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::first();

            event(new \NextDeveloper\Commons\Events\CommonCurrency\CommonCurrencyRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncurrency_event_code_filter()
    {
        try {
            $request = new Request(
                [
                'code'  =>  'a'
                ]
            );

            $filter = new CommonCurrencyQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncurrency_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonCurrencyQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCurrency::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}