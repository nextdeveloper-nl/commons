<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\RemindableQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractRemindableService;

trait RemindableTestTraits
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

    public function test_http_remindable_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/remindable',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_remindable_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/remindable', [
            'form_params'   =>  [
                'remindable_object_type'  =>  'a',
                'note'  =>  'a',
                    'remind_datetime'  =>  now(),
                    'snooze_datetime'  =>  now(),
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
    public function test_remindable_model_get()
    {
        $result = AbstractRemindableService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_remindable_get_all()
    {
        $result = AbstractRemindableService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_remindable_get_paginated()
    {
        $result = AbstractRemindableService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_remindable_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Remindable\RemindableRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_remindable_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Remindable::first();

            event( new \NextDeveloper\Commons\Events\Remindable\RemindableRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_remindable_object_type_filter()
    {
        try {
            $request = new Request([
                'remindable_object_type'  =>  'a'
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_note_filter()
    {
        try {
            $request = new Request([
                'note'  =>  'a'
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_remind_datetime_filter_start()
    {
        try {
            $request = new Request([
                'remind_datetimeStart'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_snooze_datetime_filter_start()
    {
        try {
            $request = new Request([
                'snooze_datetimeStart'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_remind_datetime_filter_end()
    {
        try {
            $request = new Request([
                'remind_datetimeEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_snooze_datetime_filter_end()
    {
        try {
            $request = new Request([
                'snooze_datetimeEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_remind_datetime_filter_start_and_end()
    {
        try {
            $request = new Request([
                'remind_datetimeStart'  =>  now(),
                'remind_datetimeEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_snooze_datetime_filter_start_and_end()
    {
        try {
            $request = new Request([
                'snooze_datetimeStart'  =>  now(),
                'snooze_datetimeEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_remindable_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new RemindableQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Remindable::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
