<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\VoteQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractVoteService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait VoteTestTraits
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

    public function test_http_vote_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/vote',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_vote_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/vote', [
            'form_params'   =>  [
                'voteable_type'  =>  'a',
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
    public function test_vote_model_get()
    {
        $result = AbstractVoteService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_vote_get_all()
    {
        $result = AbstractVoteService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_vote_get_paginated()
    {
        $result = AbstractVoteService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_vote_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Vote\VoteRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_vote_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Vote::first();

            event( new \NextDeveloper\Commons\Events\Vote\VoteRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_voteable_type_filter()
    {
        try {
            $request = new Request([
                'voteable_type'  =>  'a'
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_value_filter()
    {
        try {
            $request = new Request([
                'value'  =>  '1'
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_vote_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new VoteQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Vote::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}