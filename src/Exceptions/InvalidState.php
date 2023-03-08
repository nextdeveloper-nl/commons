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
 * Class InvalidState
 * @package  NextDeveloper\Commons\Exceptions
 */
class InvalidState extends AbstractCommonsException
{
    /**
     * @param $name
     *
     * @return InvalidState
     */
    public static function create($name) {
        return new self( "The state `{$name}` is an invalid status." );
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function render($request) {
        return response()->api()->errorBadRequest( $this->getMessage() );
    }
}