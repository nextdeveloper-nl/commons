<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\URL;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Media;
use NextDeveloper\Commons\Helpers\ObjectHelper;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractMediaTransformer;

/**
 * Class MediaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class MediaTransformer extends AbstractMediaTransformer {

    /**
     * @param Media $model
     *
     * @return array
     */
    public function transform(Media $model) {
        return CacheHelper::rememberTransformed(
            'Media',
            $model->uuid,
            function () use ($model) {
                $transformed = parent::transform($model);

                //  The record the file belongs to, by its uuid rather than the internal id.
                $transformed['object_id'] = ObjectHelper::getObjectUuid($model->object_type, $model->object_id);

                $transformed['cdn_url'] = $model->cdn_url ?: $this->signedUrl($model);

                return $transformed;
            }
        );
    }

    /**
     * A link a browser can load for a file kept on a filesystem disk, which has no public address.
     * It outlives the cached payload it is part of (commons.cache.transformed_ttl).
     */
    private function signedUrl(Media $model): ?string
    {
        $minutes = (int) config('commons.media.signed_url_minutes');
        $path = $model->custom_properties['path'] ?? null;

        if ($minutes <= 0 || !$path || !$model->disk) {
            return null;
        }

        return URL::to(URL::temporarySignedRoute(
            'commons.media.file',
            now()->addMinutes($minutes),
            ['uuid' => $model->uuid],
            false
        ));
    }
}
