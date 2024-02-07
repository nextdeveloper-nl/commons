<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonValidatableQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonValidatableService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonValidatableTestTraits
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

    public function test_http_commonvalidatable_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonvalidatable',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonvalidatable_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonvalidatable', [
            'form_params'   =>  [
                'object_type'  =>  'a',
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
    public function test_commonvalidatable_model_get()
    {
        $result = AbstractCommonValidatableService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonvalidatable_get_all()
    {
        $result = AbstractCommonValidatableService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonvalidatable_get_paginated()
    {
        $result = AbstractCommonValidatableService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonvalidatable_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvalidatable_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::first();

            event(new \NextDeveloper\Commons\Events\CommonValidatable\CommonValidatableRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_object_type_filter()
    {
        try {
            $request = new Request(
                [
                'object_type'  =>  'a'
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvalidatable_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonValidatableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonValidatable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}