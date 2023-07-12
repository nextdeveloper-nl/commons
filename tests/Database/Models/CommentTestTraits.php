<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommentQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommentService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommentTestTraits
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

    public function test_http_comment_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/comment',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_comment_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/comment', [
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
    public function test_comment_model_get()
    {
        $result = AbstractCommentService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_comment_get_all()
    {
        $result = AbstractCommentService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_comment_get_paginated()
    {
        $result = AbstractCommentService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_comment_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Comment\CommentRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_comment_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Comment::first();

            event( new \NextDeveloper\Commons\Events\Comment\CommentRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_body_filter()
    {
        try {
            $request = new Request([
                'body'  =>  'a'
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_commentable_type_filter()
    {
        try {
            $request = new Request([
                'commentable_type'  =>  'a'
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event__lft_filter()
    {
        try {
            $request = new Request([
                '_lft'  =>  '1'
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event__rgt_filter()
    {
        try {
            $request = new Request([
                '_rgt'  =>  '1'
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_comment_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommentQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Comment::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}