<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\TagQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractTagService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait TagTestTraits
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

    public function test_http_tag_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/tag',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_tag_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/tag', [
            'form_params'   =>  [
                'name'  =>  'a',
                'description'  =>  'a',
                'slug'  =>  'a',
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
    public function test_tag_model_get()
    {
        $result = AbstractTagService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_tag_get_all()
    {
        $result = AbstractTagService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_tag_get_paginated()
    {
        $result = AbstractTagService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_tag_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Tag\TagRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_tag_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Tag::first();

            event( new \NextDeveloper\Commons\Events\Tag\TagRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_description_filter()
    {
        try {
            $request = new Request([
                'description'  =>  'a'
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_slug_filter()
    {
        try {
            $request = new Request([
                'slug'  =>  'a'
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_tag_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new TagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Tag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}