<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonCountryQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonCountryService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonCountryTestTraits
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

    public function test_http_commoncountry_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commoncountry',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commoncountry_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commoncountry', [
            'form_params'   =>  [
                'code'  =>  'a',
                'locale'  =>  'a',
                'name'  =>  'a',
                'currency_code'  =>  'a',
                'phone_code'  =>  'a',
                'continent_name'  =>  'a',
                'continent_code'  =>  'a',
                'vat_rate'  =>  '1',
                'geo_name_identitiy'  =>  '1',
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
    public function test_commoncountry_model_get()
    {
        $result = AbstractCommonCountryService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncountry_get_all()
    {
        $result = AbstractCommonCountryService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncountry_get_paginated()
    {
        $result = AbstractCommonCountryService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commoncountry_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountrySavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountrySavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountrySavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountrySavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncountry_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::first();

            event(new \NextDeveloper\Commons\Events\CommonCountry\CommonCountryRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_code_filter()
    {
        try {
            $request = new Request(
                [
                'code'  =>  'a'
                ]
            );

            $filter = new CommonCountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_locale_filter()
    {
        try {
            $request = new Request(
                [
                'locale'  =>  'a'
                ]
            );

            $filter = new CommonCountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonCountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_currency_code_filter()
    {
        try {
            $request = new Request(
                [
                'currency_code'  =>  'a'
                ]
            );

            $filter = new CommonCountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_phone_code_filter()
    {
        try {
            $request = new Request(
                [
                'phone_code'  =>  'a'
                ]
            );

            $filter = new CommonCountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_continent_name_filter()
    {
        try {
            $request = new Request(
                [
                'continent_name'  =>  'a'
                ]
            );

            $filter = new CommonCountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_continent_code_filter()
    {
        try {
            $request = new Request(
                [
                'continent_code'  =>  'a'
                ]
            );

            $filter = new CommonCountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_vat_rate_filter()
    {
        try {
            $request = new Request(
                [
                'vat_rate'  =>  '1'
                ]
            );

            $filter = new CommonCountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncountry_event_geo_name_identitiy_filter()
    {
        try {
            $request = new Request(
                [
                'geo_name_identitiy'  =>  '1'
                ]
            );

            $filter = new CommonCountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCountry::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}