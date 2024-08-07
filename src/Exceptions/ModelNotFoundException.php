<?php
/**
 * This file is part of the PlusClouds.Core library.
 *
 * (c) Semih Turna <semih.turna@plusclouds.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace  NextDeveloper\Commons\Exceptions;


/**
 * Class ModelNotFoundException
 * @package  NextDeveloper\Commons\Exceptions
 */
class ModelNotFoundException extends AbstractCommonsException
{

    /**
     * @var string
     */
    protected $defaultMessage = 'Could not find the records you are looking for.';

    /**
     * @param null $request
     * @param \Illuminate\Http\Request
     *
     * @return mixed
     */
    public function render($request = null) {
        $message = $this->getMessage();

        if( str_contains( $message, $this->defaultMessage )
            || str_contains( $message, 'No query results for model' ) ) {
            $message = null;
        }

        return response()->api()->errorNotFound( $message ?: $this->defaultMessage );
    }

}
