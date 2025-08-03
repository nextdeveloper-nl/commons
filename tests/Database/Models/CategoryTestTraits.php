<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CategoryQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCategoryService;

trait CategoryTestTraits
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

    public function test_http_category_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/category',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_category_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/category', [
            'form_params'   =>  [
                'slug'  =>  'a',
                'name'  =>  'a',
                'description'  =>  'a',
                'url'  =>  'a',
                '_lft'  =>  '1',
                '_rgt'  =>  '1',
                'order'  =>  '1',
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
    public function test_category_model_get()
    {
        $result = AbstractCategoryService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_category_get_all()
    {
        $result = AbstractCategoryService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_category_get_paginated()
    {
        $result = AbstractCategoryService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_category_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategoryRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategoryCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategoryCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategorySavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategorySavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategoryUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategoryUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategoryDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategoryDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategoryRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Category\CategoryRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategoryRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategoryCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategoryCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategorySavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategorySavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategoryUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategoryUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategoryDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategoryDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategoryRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_category_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Category::first();

            event( new \NextDeveloper\Commons\Events\Category\CategoryRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_slug_filter()
    {
        try {
            $request = new Request([
                'slug'  =>  'a'
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_description_filter()
    {
        try {
            $request = new Request([
                'description'  =>  'a'
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_url_filter()
    {
        try {
            $request = new Request([
                'url'  =>  'a'
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event__lft_filter()
    {
        try {
            $request = new Request([
                '_lft'  =>  '1'
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event__rgt_filter()
    {
        try {
            $request = new Request([
                '_rgt'  =>  '1'
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_order_filter()
    {
        try {
            $request = new Request([
                'order'  =>  '1'
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_category_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CategoryQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Category::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
