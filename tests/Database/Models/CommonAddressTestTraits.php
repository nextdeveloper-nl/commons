<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonAddressQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonAddressService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonAddressTestTraits
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

    public function test_http_commonaddress_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonaddress',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_commonaddress_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/commonaddress', [
            'form_params'   =>  [
                'addressable_type'  =>  'a',
                'name'  =>  'a',
                'line1'  =>  'a',
                'line2'  =>  'a',
                'city'  =>  'a',
                'state'  =>  'a',
                'state_code'  =>  'a',
                'postcode'  =>  'a',
                'email_address'  =>  'a',
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
    public function test_commonaddress_model_get()
    {
        $result = AbstractCommonAddressService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonaddress_get_all()
    {
        $result = AbstractCommonAddressService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonaddress_get_paginated()
    {
        $result = AbstractCommonAddressService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonaddress_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonaddress_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::first();

            event( new \NextDeveloper\Commons\Events\CommonAddress\CommonAddressRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_addressable_type_filter()
    {
        try {
            $request = new Request([
                'addressable_type'  =>  'a'
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_line1_filter()
    {
        try {
            $request = new Request([
                'line1'  =>  'a'
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_line2_filter()
    {
        try {
            $request = new Request([
                'line2'  =>  'a'
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_city_filter()
    {
        try {
            $request = new Request([
                'city'  =>  'a'
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_state_filter()
    {
        try {
            $request = new Request([
                'state'  =>  'a'
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_state_code_filter()
    {
        try {
            $request = new Request([
                'state_code'  =>  'a'
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_postcode_filter()
    {
        try {
            $request = new Request([
                'postcode'  =>  'a'
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_email_address_filter()
    {
        try {
            $request = new Request([
                'email_address'  =>  'a'
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonaddress_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommonAddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonAddress::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}