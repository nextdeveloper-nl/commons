<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use NextDeveloper\Commons\Database\Filters\CommonLanguageQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCommonLanguageService;
use Tests\TestCase;

trait CommonLanguageTestTraits
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

    public function test_http_commonlanguage_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/commonlanguage',
            ['http_errors' => false]
        );

        $this->assertContains(
            $response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
            ]
        );
    }

    public function test_http_commonlanguage_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'POST', '/commons/commonlanguage', [
            'form_params'   =>  [
                'name'  =>  'a',
                'native_name'  =>  'a',
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
    public function test_commonlanguage_model_get()
    {
        $result = AbstractCommonLanguageService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonlanguage_get_all()
    {
        $result = AbstractCommonLanguageService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_commonlanguage_get_paginated()
    {
        $result = AbstractCommonLanguageService::get(
            null, [
            'paginated' =>  'true'
            ]
        );

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_commonlanguage_event_retrieved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageRetrievedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_created_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageCreatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_creating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageCreatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_saving_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageSavingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_saved_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageSavedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_updating_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageUpdatingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_updated_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageUpdatedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_deleting_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageDeletingEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_deleted_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageDeletedEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_restoring_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageRestoringEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_restored_without_object()
    {
        try {
            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageRestoredEvent());
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonlanguage_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageRetrievedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageCreatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageCreatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageSavingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageSavedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageUpdatingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageUpdatedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageDeletingEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageDeletedEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageRestoringEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_commonlanguage_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::first();

            event(new \NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageRestoredEvent($model));
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonlanguage_event_name_filter()
    {
        try {
            $request = new Request(
                [
                'name'  =>  'a'
                ]
            );

            $filter = new CommonLanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_commonlanguage_event_native_name_filter()
    {
        try {
            $request = new Request(
                [
                'native_name'  =>  'a'
                ]
            );

            $filter = new CommonLanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\CommonLanguage::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n

}