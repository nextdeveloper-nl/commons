<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\MediumQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractMediumService;

trait MediumTestTraits
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

    public function test_http_medium_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/medium',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_medium_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/medium', [
            'form_params'   =>  [
                'mediable_type'  =>  'a',
                'collection_name'  =>  'a',
                'name'  =>  'a',
                'cdn_url'  =>  'a',
                'file_name'  =>  'a',
                'mime_type'  =>  'a',
                'disk'  =>  'a',
                'manipulations'  =>  'a',
                'custom_properties'  =>  'a',
                'size'  =>  '1',
                'order_column'  =>  '1',
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
    public function test_medium_model_get()
    {
        $result = AbstractMediumService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_medium_get_all()
    {
        $result = AbstractMediumService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_medium_get_paginated()
    {
        $result = AbstractMediumService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_medium_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Medium\MediumRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_medium_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Medium::first();

            event( new \NextDeveloper\Commons\Events\Medium\MediumRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_mediable_type_filter()
    {
        try {
            $request = new Request([
                'mediable_type'  =>  'a'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_collection_name_filter()
    {
        try {
            $request = new Request([
                'collection_name'  =>  'a'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_cdn_url_filter()
    {
        try {
            $request = new Request([
                'cdn_url'  =>  'a'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_file_name_filter()
    {
        try {
            $request = new Request([
                'file_name'  =>  'a'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_mime_type_filter()
    {
        try {
            $request = new Request([
                'mime_type'  =>  'a'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_disk_filter()
    {
        try {
            $request = new Request([
                'disk'  =>  'a'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_manipulations_filter()
    {
        try {
            $request = new Request([
                'manipulations'  =>  'a'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_custom_properties_filter()
    {
        try {
            $request = new Request([
                'custom_properties'  =>  'a'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_size_filter()
    {
        try {
            $request = new Request([
                'size'  =>  '1'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_order_column_filter()
    {
        try {
            $request = new Request([
                'order_column'  =>  '1'
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_medium_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new MediumQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Medium::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
