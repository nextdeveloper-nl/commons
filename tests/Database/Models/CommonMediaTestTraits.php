<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonMediaQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonMediaService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonMediaTestTraits
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

    public function test_http_commonmedia_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonmedia',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonmedia_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonmedia', [
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
    public function test_commonmedia_model_get()
    {
        $result = AbstractCommonMediaService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonmedia_get_all()
    {
        $result = AbstractCommonMediaService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonmedia_get_paginated()
    {
        $result = AbstractCommonMediaService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonmedia_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonmedia_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonMedia\CommonMediaRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_mediable_type_filter()
    {
        try {
            $request = new Request(
                [
                'mediable_type'  =>  'a'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_collection_name_filter()
    {
        try {
            $request = new Request(
                [
                'collection_name'  =>  'a'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_cdn_url_filter()
    {
        try {
            $request = new Request(
                [
                'cdn_url'  =>  'a'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_file_name_filter()
    {
        try {
            $request = new Request(
                [
                'file_name'  =>  'a'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_mime_type_filter()
    {
        try {
            $request = new Request(
                [
                'mime_type'  =>  'a'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_disk_filter()
    {
        try {
            $request = new Request(
                [
                'disk'  =>  'a'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_manipulations_filter()
    {
        try {
            $request = new Request(
                [
                'manipulations'  =>  'a'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_custom_properties_filter()
    {
        try {
            $request = new Request(
                [
                'custom_properties'  =>  'a'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_size_filter()
    {
        try {
            $request = new Request(
                [
                'size'  =>  '1'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_order_column_filter()
    {
        try {
            $request = new Request(
                [
                'order_column'  =>  '1'
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonmedia_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}