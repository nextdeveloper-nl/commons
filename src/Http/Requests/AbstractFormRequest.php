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
     * Generated rules look like 'nullable|exists:table,uuid|uuid'. Rules run in order, so `exists` hit the
     * database with a malformed uuid (invalid input syntax for type uuid) and answered 500 instead of 422.
     * Here the `uuid` rule is moved in front of every `exists:` rule so the format is checked first.
     *
     * @return array
     */
    protected function validationRules() {
        $rules = parent::validationRules();

        foreach ($rules as $field => $rule) {
            if (is_string($rule)) {
                $parts = explode('|', $rule);
                $isString = true;
            } elseif (is_array($rule)) {
                $parts = $rule;
                $isString = false;
            } else {
                continue;
            }

            $uuidIndex = array_search('uuid', $parts, true);
            if ($uuidIndex === false) {
                continue;
            }

            $existsIndex = null;
            foreach ($parts as $i => $part) {
                if (is_string($part) && str_starts_with($part, 'exists:')) {
                    $existsIndex = $i;
                    break;
                }
            }

            if ($existsIndex === null || $uuidIndex < $existsIndex) {
                continue;
            }

            unset($parts[$uuidIndex]);
            array_splice($parts, $existsIndex, 0, ['uuid']);
            $parts = array_values($parts);

            $rules[$field] = $isString ? implode('|', $parts) : $parts;
        }

        return $rules;
    }

    /**
     * @return void
     */
    public function prepareForValidation() {
        $this->request->remove('locale');
    }
}
