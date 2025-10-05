<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CommonPhoneNumberQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonPhoneNumberService;
use Tests\TestCase;

trait CommonPhoneNumberTestTraits
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

    public function test_http_commonphonenumber_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonphonenumber',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonphonenumber_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonphonenumber', [
            'form_params'   =>  [
                'object_type'  =>  'a',
                'name'  =>  'a',
                'code'  =>  'a',
                'number'  =>  'a',
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
    public function test_commonphonenumber_model_get()
    {
        $result = AbstractCommonPhoneNumberService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonphonenumber_get_all()
    {
        $result = AbstractCommonPhoneNumberService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonphonenumber_get_paginated()
    {
        $result = AbstractCommonPhoneNumberService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonphonenumber_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonphonenumber_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::first();

            event(new \NextDeveloper\Commons\Events\CommonPhoneNumber\CommonPhoneNumberRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_object_type_filter()
    {
        try {
            $request = new Request(
                [
                'object_type'  =>  'a'
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_code_filter()
    {
        try {
            $request = new Request(
                [
                'code'  =>  'a'
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_number_filter()
    {
        try {
            $request = new Request(
                [
                'number'  =>  'a'
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonphonenumber_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonPhoneNumberQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonPhoneNumber::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}