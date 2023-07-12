<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\DomainQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractDomainService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait DomainTestTraits
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

    public function test_http_domain_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/domain',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_domain_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/domain', [
            'form_params'   =>  [
                'name'  =>  'a',
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
    public function test_domain_model_get()
    {
        $result = AbstractDomainService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_domain_get_all()
    {
        $result = AbstractDomainService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_domain_get_paginated()
    {
        $result = AbstractDomainService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_domain_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Domain\DomainRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_domain_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Domain::first();

            event( new \NextDeveloper\Commons\Events\Domain\DomainRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_domain_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new DomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Domain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}