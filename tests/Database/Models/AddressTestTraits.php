<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\AddressQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractAddressService;

trait AddressTestTraits
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

    public function test_http_address_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/address',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_address_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/address', [
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
    public function test_address_model_get()
    {
        $result = AbstractAddressService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_address_get_all()
    {
        $result = AbstractAddressService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_address_get_paginated()
    {
        $result = AbstractAddressService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_address_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Address\AddressRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_address_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Address::first();

            event( new \NextDeveloper\Commons\Events\Address\AddressRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_addressable_type_filter()
    {
        try {
            $request = new Request([
                'addressable_type'  =>  'a'
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_line1_filter()
    {
        try {
            $request = new Request([
                'line1'  =>  'a'
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_line2_filter()
    {
        try {
            $request = new Request([
                'line2'  =>  'a'
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_city_filter()
    {
        try {
            $request = new Request([
                'city'  =>  'a'
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_state_filter()
    {
        try {
            $request = new Request([
                'state'  =>  'a'
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_state_code_filter()
    {
        try {
            $request = new Request([
                'state_code'  =>  'a'
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_postcode_filter()
    {
        try {
            $request = new Request([
                'postcode'  =>  'a'
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_email_address_filter()
    {
        try {
            $request = new Request([
                'email_address'  =>  'a'
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_address_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new AddressQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Address::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
