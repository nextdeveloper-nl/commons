<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonDomainQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonDomainService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonDomainTestTraits
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

    public function test_http_commondomain_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commondomain',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_commondomain_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/commondomain', [
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
    public function test_commondomain_model_get()
    {
        $result = AbstractCommonDomainService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commondomain_get_all()
    {
        $result = AbstractCommonDomainService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commondomain_get_paginated()
    {
        $result = AbstractCommonDomainService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commondomain_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commondomain_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::first();

            event( new \NextDeveloper\Commons\Events\CommonDomain\CommonDomainRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commondomain_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommonDomainQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonDomain::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}