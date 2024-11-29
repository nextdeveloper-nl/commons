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

    protected $defaultMessage = 'The object that you are looking is not in its place :/ weird yeah ?';

    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
