<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CountryQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCountryService;

trait CountryTestTraits
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

    public function test_http_country_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/country',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_country_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/country', [
            'form_params'   =>  [
                'code'  =>  'a',
                'locale'  =>  'a',
                'name'  =>  'a',
                'currency_code'  =>  'a',
                'phone_code'  =>  'a',
                'continent_name'  =>  'a',
                'continent_code'  =>  'a',
                'vat_rate'  =>  '1',
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
    public function test_country_model_get()
    {
        $result = AbstractCountryService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_country_get_all()
    {
        $result = AbstractCountryService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_country_get_paginated()
    {
        $result = AbstractCountryService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_country_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountryRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountryCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountryCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountrySavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountrySavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountryUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountryUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountryDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountryDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountryRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Country\CountryRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountryRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountryCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountryCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountrySavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountrySavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountryUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountryUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountryDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountryDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountryRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Country\CountryRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_code_filter()
    {
        try {
            $request = new Request([
                'code'  =>  'a'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_locale_filter()
    {
        try {
            $request = new Request([
                'locale'  =>  'a'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_currency_code_filter()
    {
        try {
            $request = new Request([
                'currency_code'  =>  'a'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_phone_code_filter()
    {
        try {
            $request = new Request([
                'phone_code'  =>  'a'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_continent_name_filter()
    {
        try {
            $request = new Request([
                'continent_name'  =>  'a'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_continent_code_filter()
    {
        try {
            $request = new Request([
                'continent_code'  =>  'a'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_vat_rate_filter()
    {
        try {
            $request = new Request([
                'vat_rate'  =>  '1'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
