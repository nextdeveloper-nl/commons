<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonDisposableEmail;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonDisposableEmailTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonDisposableEmailTransformer extends AbstractTransformer {

    /**
     * @param CommonDisposableEmail $model
     *
     * @return array
     */
    public function transform(CommonDisposableEmail $model) {
                        $commonDomainId = \NextDeveloper\Commons\Database\Models\CommonDomain::where('id', $model->common_domain_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->uuid,
'common_domain_id'  =>  $commonDomainId ? $commonDomainId->uuid : null,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
'deleted_at'  =>  $model->deleted_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n








}
