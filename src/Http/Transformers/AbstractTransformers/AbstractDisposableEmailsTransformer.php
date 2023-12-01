<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\DisposableEmails;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class DisposableEmailsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractDisposableEmailsTransformer extends AbstractTransformer
{

    /**
     * @param DisposableEmails $model
     *
     * @return array
     */
    public function transform(DisposableEmails $model)
    {
                        $commonDomainId = \NextDeveloper\Commons\Database\Models\Domains::where('id', $model->common_domain_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'common_domain_id'  =>  $commonDomainId ? $commonDomainId->uuid : null,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
































}
