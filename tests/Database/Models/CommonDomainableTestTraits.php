<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonDomainableQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonDomainableService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonDomainableTestTraits
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

    public function test_http_commondomainable_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commondomainable',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_commondomainable_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/commondomainable', [
            'form_params'   =>  [
                'domainable_type'  =>  'a',
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
    public function test_commondomainable_model_get()
    {
        $result = AbstractCommonDomainableService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commondomainable_get_all()
    {
        $result = AbstractCommonDomainableService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commondomainable_get_paginated()
    {
        $result = AbstractCommonDomainableService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commondomainable_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomainable_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomainable_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::first();

            event( new \NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomainable_event_domainable_type_filter()
    {
        try {
            $request = new Request([
                'domainable_type'  =>  'a'
            ]);

            $filter = new CommonDomainableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomainable_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new CommonDomainableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomainable_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new CommonDomainableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomainable_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomainable_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomainable_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomainable_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomainable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}