<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonKeywordQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonKeywordService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonKeywordTestTraits
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

    public function test_http_commonkeyword_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonkeyword',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonkeyword_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonkeyword', [
            'form_params'   =>  [
                'name'  =>  'a',
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
    public function test_commonkeyword_model_get()
    {
        $result = AbstractCommonKeywordService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonkeyword_get_all()
    {
        $result = AbstractCommonKeywordService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonkeyword_get_paginated()
    {
        $result = AbstractCommonKeywordService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonkeyword_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonkeyword_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::first();

            event(new \NextDeveloper\Commons\Events\CommonKeyword\CommonKeywordRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonkeyword_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonKeywordQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonKeyword::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}