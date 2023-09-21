<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonDisposableEmailQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonDisposableEmailService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonDisposableEmailTestTraits
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

    public function test_http_commondisposableemail_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commondisposableemail',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commondisposableemail_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commondisposableemail', [
            'form_params'   =>  [
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
    public function test_commondisposableemail_model_get()
    {
        $result = AbstractCommonDisposableEmailService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commondisposableemail_get_all()
    {
        $result = AbstractCommonDisposableEmailService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commondisposableemail_get_paginated()
    {
        $result = AbstractCommonDisposableEmailService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commondisposableemail_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondisposableemail_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::first();

            event(new \NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonDisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonDisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonDisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonDisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonDisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonDisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonDisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonDisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondisposableemail_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonDisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}