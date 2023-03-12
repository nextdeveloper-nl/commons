<?php
/**
 * This file is part of the NextDeveloper.Commons library.
 *
 * Originally written by (c) Semih Turna <semih.turna@plusclouds.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NextDeveloper\Commons\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use NextDeveloper\Commons\Common\Enums\GenericErrorCodes;

/**
 * Class AbstractFormRequest.
 *
 * @package PlusClouds\Core\Http\Requests
 */
abstract class AbstractFormRequest extends FormRequest {
    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) {
        $errors = ( new ValidationException($validator) )->errors();

        $data = [
            'message' =>  'Validation failed. Please fix the values you are providing and try again.',
            'code'  =>  GenericErrorCodes::VALIDATION_FAILED,
            'errors'    =>  $errors
        ];

        throw new HttpResponseException(response()->json($data, 422));
    }

    /**
     * @return void
     */
    public function prepareForValidation() {
        $this->request->remove('locale');
    }
}
