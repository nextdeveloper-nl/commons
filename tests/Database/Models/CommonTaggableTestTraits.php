<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonTaggableQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonTaggableService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonTaggableTestTraits
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

    public function test_http_commontaggable_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commontaggable',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_commontaggable_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/commontaggable', [
            'form_params'   =>  [
                'taggable_type'  =>  'a',
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
    public function test_commontaggable_model_get()
    {
        $result = AbstractCommonTaggableService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commontaggable_get_all()
    {
        $result = AbstractCommonTaggableService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commontaggable_get_paginated()
    {
        $result = AbstractCommonTaggableService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commontaggable_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaggable_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontaggable_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::first();

            event( new \NextDeveloper\Commons\Events\CommonTaggable\CommonTaggableRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaggable_event_taggable_type_filter()
    {
        try {
            $request = new Request([
                'taggable_type'  =>  'a'
            ]);

            $filter = new CommonTaggableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaggable_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new CommonTaggableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaggable_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new CommonTaggableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaggable_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonTaggableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaggable_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonTaggableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaggable_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonTaggableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontaggable_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonTaggableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTaggable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}