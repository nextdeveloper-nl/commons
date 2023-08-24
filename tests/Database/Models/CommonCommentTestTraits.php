<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonCommentQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonCommentService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonCommentTestTraits
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

    public function test_http_commoncomment_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commoncomment',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_commoncomment_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/commoncomment', [
            'form_params'   =>  [
                'body'  =>  'a',
                'commentable_type'  =>  'a',
                '_lft'  =>  '1',
                '_rgt'  =>  '1',
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
    public function test_commoncomment_model_get()
    {
        $result = AbstractCommonCommentService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncomment_get_all()
    {
        $result = AbstractCommonCommentService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncomment_get_paginated()
    {
        $result = AbstractCommonCommentService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commoncomment_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncomment_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonComment::first();

            event( new \NextDeveloper\Commons\Events\CommonComment\CommonCommentRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_body_filter()
    {
        try {
            $request = new Request([
                'body'  =>  'a'
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_commentable_type_filter()
    {
        try {
            $request = new Request([
                'commentable_type'  =>  'a'
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event__lft_filter()
    {
        try {
            $request = new Request([
                '_lft'  =>  '1'
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event__rgt_filter()
    {
        try {
            $request = new Request([
                '_rgt'  =>  '1'
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncomment_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommonCommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonComment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}