<?php

namespace NextDeveloper\Commons\Elasticsearch;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

/**
 * Builds the shared Elasticsearch client from config('elasticsearch.*'). Bound as a
 * singleton in CommonsServiceProvider so the indexing job and the read-path services
 * all share one configured client/connection pool.
 */
class ElasticsearchClientFactory
{
    public static function make(): Client
    {
        $builder = ClientBuilder::create()
            ->setHosts(config('elasticsearch.hosts', ['http://127.0.0.1:9200']));

        if ($apiKey = config('elasticsearch.api_key')) {
            $builder->setApiKey($apiKey);
        } elseif (config('elasticsearch.username') && config('elasticsearch.password')) {
            $builder->setBasicAuthentication(
                config('elasticsearch.username'),
                config('elasticsearch.password')
            );
        }

        if ($caCert = config('elasticsearch.ca_cert')) {
            $builder->setCABundle($caCert);
        }

        return $builder->build();
    }
}
