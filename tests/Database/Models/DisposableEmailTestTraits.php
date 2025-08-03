<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\DisposableEmailQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractDisposableEmailService;

trait DisposableEmailTestTraits
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

    public function test_http_disposableemail_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/disposableemail',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_disposableemail_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/disposableemail', [
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
    public function test_disposableemail_model_get()
    {
        $result = AbstractDisposableEmailService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_disposableemail_get_all()
    {
        $result = AbstractDisposableEmailService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_disposableemail_get_paginated()
    {
        $result = AbstractDisposableEmailService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_disposableemail_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_disposableemail_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::first();

            event( new \NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new DisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new DisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new DisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new DisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new DisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new DisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new DisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new DisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_disposableemail_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new DisposableEmailQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\DisposableEmail::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
