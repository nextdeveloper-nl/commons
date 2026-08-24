<?php

namespace NextDeveloper\Commons\Elasticsearch\Contracts;

/**
 * Implemented by models that get indexed into Elasticsearch. This is the seam between
 * a specific model and SyncModelToElasticsearchJob - the job only knows how to call
 * toElasticDocument()/getElasticIndexName(), it never needs model-specific knowledge.
 */
interface ElasticSyncable
{
    /**
     * The document to index, keyed however the model wants - the sync job stores it
     * under the model's uuid as the ES _id, so the returned array does not need an id.
     */
    public function toElasticDocument(): array;

    /**
     * The alias (not the physical versioned index) the model is indexed/read through.
     */
    public function getElasticIndexName(): string;
}
