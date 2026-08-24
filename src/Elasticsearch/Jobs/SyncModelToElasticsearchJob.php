<?php

namespace NextDeveloper\Commons\Elasticsearch\Jobs;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Elasticsearch\Contracts\ElasticSyncable;

/**
 * Generic ES upsert/delete job dispatched by Events::fire() (registered per model via
 * Events::listen()) - keeps or removes one document per lifecycle event. Upserts by the
 * model's uuid as the ES _id, so a redelivered/retried job is a no-op re-write, not a
 * duplicate - safe to run with --tries > 1 through transient ES unavailability.
 */
class SyncModelToElasticsearchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly Model $model,
        private readonly array $params
    ) {
        $this->queue = config('elasticsearch.queue', 'elasticsearch');
    }

    public function handle(Client $client): void
    {
        if (! $this->model instanceof ElasticSyncable) {
            Log::warning('[SyncModelToElasticsearchJob] Model does not implement ElasticSyncable, skipping', [
                'model' => get_class($this->model),
                'event' => $this->params['event'] ?? null,
            ]);

            return;
        }

        $eventName = $this->params['event'] ?? '';
        $index = $this->model->getElasticIndexName();
        $id = $this->model->uuid;

        try {
            if (str_starts_with($eventName, 'deleted:')) {
                $this->delete($client, $index, $id);

                return;
            }

            $client->index([
                'index' => $index,
                'id' => $id,
                'body' => $this->model->toElasticDocument(),
            ]);
        } catch (\Throwable $e) {
            Log::error('[SyncModelToElasticsearchJob] Failed to sync model to Elasticsearch', [
                'model' => get_class($this->model),
                'uuid' => $id,
                'event' => $eventName,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    private function delete(Client $client, string $index, string $id): void
    {
        try {
            $client->delete([
                'index' => $index,
                'id' => $id,
            ]);
        } catch (ClientResponseException $e) {
            //  404 on delete means the document is already gone (or was never indexed) -
            //  that's the desired end state, not a failure.
            if ($e->getCode() !== 404) {
                throw $e;
            }
        }
    }
}
