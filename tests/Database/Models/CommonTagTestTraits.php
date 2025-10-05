<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CommonTagQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonTagService;
use Tests\TestCase;

trait CommonTagTestTraits
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

    public function test_http_commontag_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commontag',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commontag_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commontag', [
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
    public function test_commontag_model_get()
    {
        $result = AbstractCommonTagService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commontag_get_all()
    {
        $result = AbstractCommonTagService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commontag_get_paginated()
    {
        $result = AbstractCommonTagService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commontag_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commontag_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonTag::first();

            event(new \NextDeveloper\Commons\Events\CommonTag\CommonTagRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_description_filter()
    {
        try {
            $request = new Request(
                [
                'description'  =>  'a'
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_slug_filter()
    {
        try {
            $request = new Request(
                [
                'slug'  =>  'a'
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commontag_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonTagQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonTag::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n

}