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

    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
