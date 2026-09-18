<?php

return [
    // Set to true to enable Elasticsearch document sync (writes still go to Postgres;
    // this only controls whether model changes get indexed into ES).
    'enabled' => env('ELASTICSEARCH_ENABLED', false),

    'hosts' => explode(',', env('ELASTICSEARCH_HOSTS', 'http://127.0.0.1:9200')),

    // Auth - use api_key OR username/password, whichever the cluster is configured for.
    // Leave all blank for an unsecured local dev cluster.
    'api_key' => env('ELASTICSEARCH_API_KEY'),
    'username' => env('ELASTICSEARCH_USERNAME'),
    'password' => env('ELASTICSEARCH_PASSWORD'),
    'ca_cert' => env('ELASTICSEARCH_CA_CERT'),

    // Queue SyncModelToElasticsearchJob is dispatched onto.
    'queue' => env('ELASTICSEARCH_QUEUE', 'elasticsearch'),

    // Prefix applied to every index name, e.g. leo_iaas_virtual_machines.
    'index_prefix' => env('ELASTICSEARCH_INDEX_PREFIX', 'leo'),
];
