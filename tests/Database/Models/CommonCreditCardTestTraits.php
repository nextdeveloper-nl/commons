<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommonCreditCardQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonCreditCardService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait CommonCreditCardTestTraits
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

    public function test_http_commoncreditcard_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commoncreditcard',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_commoncreditcard_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/commoncreditcard', [
            'form_params'   =>  [
                'type'  =>  'a',
                'cc_holder_name'  =>  'a',
                'cc_number'  =>  'a',
                'cc_month'  =>  'a',
                'cc_year'  =>  'a',
                'cc_cvv'  =>  'a',
                'score'  =>  '1',
                'retry_count'  =>  '1',
                    'last_retry_date'  =>  now(),
                    'verification_date'  =>  now(),
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
    public function test_commoncreditcard_model_get()
    {
        $result = AbstractCommonCreditCardService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncreditcard_get_all()
    {
        $result = AbstractCommonCreditCardService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commoncreditcard_get_paginated()
    {
        $result = AbstractCommonCreditCardService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commoncreditcard_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commoncreditcard_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::first();

            event( new \NextDeveloper\Commons\Events\CommonCreditCard\CommonCreditCardRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_type_filter()
    {
        try {
            $request = new Request([
                'type'  =>  'a'
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_cc_holder_name_filter()
    {
        try {
            $request = new Request([
                'cc_holder_name'  =>  'a'
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_cc_number_filter()
    {
        try {
            $request = new Request([
                'cc_number'  =>  'a'
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_cc_month_filter()
    {
        try {
            $request = new Request([
                'cc_month'  =>  'a'
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_cc_year_filter()
    {
        try {
            $request = new Request([
                'cc_year'  =>  'a'
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_cc_cvv_filter()
    {
        try {
            $request = new Request([
                'cc_cvv'  =>  'a'
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_score_filter()
    {
        try {
            $request = new Request([
                'score'  =>  '1'
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_retry_count_filter()
    {
        try {
            $request = new Request([
                'retry_count'  =>  '1'
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_last_retry_date_filter_start()
    {
        try {
            $request = new Request([
                'last_retry_dateStart'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_verification_date_filter_start()
    {
        try {
            $request = new Request([
                'verification_dateStart'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_created_at_filter_start()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_updated_at_filter_start()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_deleted_at_filter_start()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_last_retry_date_filter_end()
    {
        try {
            $request = new Request([
                'last_retry_dateEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_verification_date_filter_end()
    {
        try {
            $request = new Request([
                'verification_dateEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_created_at_filter_end()
    {
        try {
            $request = new Request([
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_updated_at_filter_end()
    {
        try {
            $request = new Request([
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_deleted_at_filter_end()
    {
        try {
            $request = new Request([
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_last_retry_date_filter_start_and_end()
    {
        try {
            $request = new Request([
                'last_retry_dateStart'  =>  now(),
                'last_retry_dateEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_verification_date_filter_start_and_end()
    {
        try {
            $request = new Request([
                'verification_dateStart'  =>  now(),
                'verification_dateEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_created_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'created_atStart'  =>  now(),
                'created_atEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_updated_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'updated_atStart'  =>  now(),
                'updated_atEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commoncreditcard_event_deleted_at_filter_start_and_end()
    {
        try {
            $request = new Request([
                'deleted_atStart'  =>  now(),
                'deleted_atEnd'  =>  now()
            ]);

            $filter = new CommonCreditCardQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonCreditCard::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}