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
 * Class NotFoundException
 * @package  NextDeveloper\Commons\Exceptions
 */
class NotFoundException extends AbstractCommonsException
{

    /**
     * @param  \Illuminate\Http\Request
     *
     * @return mixed
     */
    public function render($request) {
        return response()->api()->errorNotFound( $this->getMessage() ?: 'Requested object not found.' );
    }

}
