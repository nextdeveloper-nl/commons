<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonVoteQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonVoteService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonVoteTestTraits
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

    public function test_http_commonvote_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonvote',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonvote_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonvote', [
            'form_params'   =>  [
                'object_type'  =>  'a',
                'value'  =>  '1',
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
    public function test_commonvote_model_get()
    {
        $result = AbstractCommonVoteService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonvote_get_all()
    {
        $result = AbstractCommonVoteService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonvote_get_paginated()
    {
        $result = AbstractCommonVoteService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonvote_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonvote_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonVote::first();

            event(new \NextDeveloper\Commons\Events\CommonVote\CommonVoteRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_object_type_filter()
    {
        try {
            $request = new Request(
                [
                'object_type'  =>  'a'
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_value_filter()
    {
        try {
            $request = new Request(
                [
                'value'  =>  '1'
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_created_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now()
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_updated_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now()
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_deleted_at_filter_start()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now()
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_created_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_updated_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_deleted_at_filter_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonvote_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request(
                [
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
                ]
            );

            $filter = new CommonVoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonVote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}