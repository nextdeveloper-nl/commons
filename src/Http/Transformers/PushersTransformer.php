<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractPushersTransformer;
use NextDeveloper\Commons\Pushers\PusherFactory;
use NextDeveloper\Commons\Services\PushersService;

/**
 * Class PushersTransformer. This class is being used to manipulate the data we are serving to the customer
 */
class PushersTransformer extends AbstractPushersTransformer
{
    /**
     * @return array
     */
    public function transform(Pushers $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('Pushers', $model->uuid, 'Transformed')
        );

        if ($transformed) {
            return $this->hideCredentialsFromNonOwners($model, $transformed);
        }

        $transformed = parent::transform($model);

        // Convenience flag for the UI; status is the single source of truth.
        $transformed['is_active'] = $model->status !== 'disabled';

        // Model classes this pusher's driver works with; empty list = generic (any object).
        $transformed['supported_objects'] = PusherFactory::supportedObjects($model->provider);

        Cache::set(
            CacheHelper::getKey('Pushers', $model->uuid, 'Transformed'),
            $transformed
        );

        return $this->hideCredentialsFromNonOwners($model, $transformed);
    }

    /**
     * Pushers are listed for the whole account, but the token and auth header
     * are only served to the owner. Applied after the cache read because the
     * cached payload is shared between viewers.
     *
     * @param  array<string, mixed>  $transformed
     * @return array<string, mixed>
     */
    private function hideCredentialsFromNonOwners(Pushers $model, array $transformed): array
    {
        $isOwner = PushersService::isOwnedByCurrentUser($model);

        $transformed['is_owner'] = $isOwner;

        if (! $isOwner) {
            $transformed['token'] = null;
            $transformed['auth_header'] = null;
        }

        return $transformed;
    }
}
