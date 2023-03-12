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
class CannotCreateModelException extends AbstractCommonsException
{

    /**
     * @var string
     */
    protected $defaultMessage = 'Cannot create the object. Please get in touch with your software developer or
    service provider to fix your problem.';

    /**
     * @param \Illuminate\Http\Request
     *
     * @return mixed
     */
    public function render($request) {
        $message = $this->getMessage();

        $message = $this->defaultMessage . ' Here is an additional message, that may solve your problem: ' . $message;

        return response()->api()->errorUnprocessable( $message ?: $this->defaultMessage );
    }

}