<?php

namespace NextDeveloper\Commons\Http\Requests\Keywords;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class KeywordsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['name' => "string"])]
    public function rules()
    {
        return [
            'name' => 'required|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
