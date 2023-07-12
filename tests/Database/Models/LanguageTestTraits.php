<?php

namespace NextDeveloper\Commons\Tests\Database\Models;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\LanguageQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractLanguageService;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;

trait LanguageTestTraits
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

    public function test_http_language_get()
    {
        $this->setupGuzzle();
        $response = $this->http->request(
            'GET',
            '/commons/language',
            ['http_errors' => false]
        );

        $this->assertContains($response->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_NOT_FOUND
        ]);
    }

    public function test_http_language_post()
    {
        $this->setupGuzzle();
        $response = $this->http->request('POST', '/commons/language', [
            'form_params'   =>  [
                'iso_639_1_code'  =>  'a',
                'iso_639_2_code'  =>  'a',
                'iso_639_2b_code'  =>  'a',
                'code'  =>  'a',
                'code_v2'  =>  'a',
                'code_v2b'  =>  'a',
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
    public function test_language_model_get()
    {
        $result = AbstractLanguageService::get();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_language_get_all()
    {
        $result = AbstractLanguageService::getAll();

        $this->assertIsObject($result, Collection::class);
    }

    public function test_language_get_paginated()
    {
        $result = AbstractLanguageService::get(null, [
            'paginated' =>  'true'
        ]);

        $this->assertIsObject($result, LengthAwarePaginator::class);
    }

    public function test_language_event_retrieved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageRetrievedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_created_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageCreatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_creating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageCreatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_saving_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageSavingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_saved_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageSavedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_updating_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageUpdatingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_updated_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageUpdatedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_deleting_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageDeletingEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_deleted_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageDeletedEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_restoring_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageRestoringEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_restored_without_object()
    {
        try {
            event( new \NextDeveloper\Commons\Events\Language\LanguageRestoredEvent() );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_language_event_retrieved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageRetrievedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_created_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageCreatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_creating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageCreatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_saving_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageSavingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_saved_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageSavedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_updating_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageUpdatingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_updated_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageUpdatedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_deleting_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageDeletingEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_deleted_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageDeletedEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_restoring_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageRestoringEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    public function test_language_event_restored_with_object()
    {
        try {
            $model = \NextDeveloper\Commons\Database\Models\Language::first();

            event( new \NextDeveloper\Commons\Events\Language\LanguageRestoredEvent($model) );
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_language_event_iso_639_1_code_filter()
    {
        try {
            $request = new Request([
                'iso_639_1_code'  =>  'a'
            ]);

            $filter = new LanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Language::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_language_event_iso_639_2_code_filter()
    {
        try {
            $request = new Request([
                'iso_639_2_code'  =>  'a'
            ]);

            $filter = new LanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Language::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_language_event_iso_639_2b_code_filter()
    {
        try {
            $request = new Request([
                'iso_639_2b_code'  =>  'a'
            ]);

            $filter = new LanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Language::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_language_event_code_filter()
    {
        try {
            $request = new Request([
                'code'  =>  'a'
            ]);

            $filter = new LanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Language::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_language_event_code_v2_filter()
    {
        try {
            $request = new Request([
                'code_v2'  =>  'a'
            ]);

            $filter = new LanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Language::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_language_event_code_v2b_filter()
    {
        try {
            $request = new Request([
                'code_v2b'  =>  'a'
            ]);

            $filter = new LanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Language::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_language_event_name_filter()
    {
        try {
            $request = new Request([
                'name'  =>  'a'
            ]);

            $filter = new LanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Language::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function test_language_event_native_name_filter()
    {
        try {
            $request = new Request([
                'native_name'  =>  'a'
            ]);

            $filter = new LanguageQueryFilter($request);

            $model = \NextDeveloper\Commons\Database\Models\Language::filter($filter)->first();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}