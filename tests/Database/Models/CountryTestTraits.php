<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CountryQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCountryService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CountryTestTraits
{
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
        $result = AbstractCountryService::getPaginated();

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_country_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Countries\CountriesRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_country_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Country::first();

            event( new \NextDeveloper\Commons\Events\Countries\CountriesRestoredEvent($model) );
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

    public function test_country_event_rate_filter()
    {
        try {
            $request = new Request([
                'rate'  =>  '1'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_country_event_percentage_filter()
    {
        try {
            $request = new Request([
                'percentage'  =>  '1'
            ]);

            $filter = new CountryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Country::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
}