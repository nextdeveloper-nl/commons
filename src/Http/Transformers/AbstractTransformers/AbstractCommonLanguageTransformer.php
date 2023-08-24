<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonLanguage;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonLanguageTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonLanguageTransformer extends AbstractTransformer {

    /**
     * @param CommonLanguage $model
     *
     * @return array
     */
    public function transform(CommonLanguage $model) {
                
        return $this->buildPayload([
'id'  =>  $model->uuid,
'iso_639_1_code'  =>  $model->iso_639_1_code,
'iso_639_2_code'  =>  $model->iso_639_2_code,
'iso_639_2b_code'  =>  $model->iso_639_2b_code,
'code'  =>  $model->code,
'code_v2'  =>  $model->code_v2,
'code_v2b'  =>  $model->code_v2b,
'name'  =>  $model->name,
'native_name'  =>  $model->native_name,
'is_default'  =>  $model->is_default,
'is_active'  =>  $model->is_active,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n

}
