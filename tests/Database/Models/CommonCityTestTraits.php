<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CommonCityQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonCityService;

trait CommonCityTestTraits
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

    public function test_http_commoncity_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commoncity',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commoncity_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commoncity', [
            'form_params'   =>  [
                'code'  =>  'a',
                'locale'  =>  'a',
                'name'  =>  'a',
                'phone_code'  =>  'a',
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
    public function test_commoncity_model_get()
    {
        $result = AbstractCommonCityService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncity_get_all()
    {
        $result = AbstractCommonCityService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncity_get_paginated()
    {
        $result = AbstractCommonCityService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commoncity_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCitySavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCitySavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncity_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCitySavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCitySavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncity_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCity::first();

            event(new \NextDeveloper\Commons\Events\CommonCity\CommonCityRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncity_event_code_filter()
    {
        try {
            $request = new Request(
                [
                'code'  =>  'a'
                ]
            );

            $filter = new CommonCityQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCity::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncity_event_locale_filter()
    {
        try {
            $request = new Request(
                [
                'locale'  =>  'a'
                ]
            );

            $filter = new CommonCityQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCity::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncity_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonCityQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCity::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncity_event_phone_code_filter()
    {
        try {
            $request = new Request(
                [
                'phone_code'  =>  'a'
                ]
            );

            $filter = new CommonCityQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCity::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncity_event_geo_name_identitiy_filter()
    {
        try {
            $request = new Request(
                [
                'geo_name_identitiy'  =>  '1'
                ]
            );

            $filter = new CommonCityQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCity::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
