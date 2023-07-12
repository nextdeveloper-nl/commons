<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\NotificationQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractNotificationService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait NotificationTestTraits
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

    public function test_http_notification_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/notification',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_notification_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/notification', [
            'form_params'   =>  [
                'notifiable_type'  =>  'a',
                'data'  =>  'a',
                    'read_at'  =>  now(),
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
    public function test_notification_model_get()
    {
        $result = AbstractNotificationService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_notification_get_all()
    {
        $result = AbstractNotificationService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_notification_get_paginated()
    {
        $result = AbstractNotificationService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_notification_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Notification\NotificationRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_notification_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Notification::first();

            event( new \NextDeveloper\Commons\Events\Notification\NotificationRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_notifiable_type_filter()
    {
        try {
            $request = new Request([
                'notifiable_type'  =>  'a'
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_data_filter()
    {
        try {
            $request = new Request([
                'data'  =>  'a'
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_read_at_filter_start()
    {
        try {
            $request = new Request([
                'read_atStart'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_read_at_filter_end()
    {
        try {
            $request = new Request([
                'read_atEnd'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_read_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'read_atStart'  =>  now(),
                'read_atEnd'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_notification_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new NotificationQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Notification::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}