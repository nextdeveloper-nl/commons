<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Actions;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractActionsTransformer;

/**
 * Class ActionsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ActionsTransformer extends AbstractActionsTransformer
{

    /**
     * @param Actions $model
     *
     * @return array
     */
    public function transform(Actions $model)
    {
        $transformed = parent::transform($model);

        return $transformed;
    }
}
