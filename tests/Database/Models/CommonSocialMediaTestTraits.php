<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonSocialMediaQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonSocialMediaService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonSocialMediaTestTraits
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

    public function test_http_commonsocialmedia_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonsocialmedia',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonsocialmedia_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonsocialmedia', [
            'form_params'   =>  [
                'object_type'  =>  'a',
                'profile_url'  =>  'a',
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
    public function test_commonsocialmedia_model_get()
    {
        $result = AbstractCommonSocialMediaService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonsocialmedia_get_all()
    {
        $result = AbstractCommonSocialMediaService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonsocialmedia_get_paginated()
    {
        $result = AbstractCommonSocialMediaService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonsocialmedia_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonsocialmedia_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::first();

            event(new \NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_object_type_filter()
    {
        try {
            $request = new Request(
                [
                'object_type'  =>  'a'
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_profile_url_filter()
    {
        try {
            $request = new Request(
                [
                'profile_url'  =>  'a'
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonsocialmedia_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonSocialMediaQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonSocialMedia::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}