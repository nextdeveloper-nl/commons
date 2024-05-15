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

use Exception;

/**
 * Class AbstractCoreException.
 *
 * @package  NextDeveloper\Commons\Exceptions
 */
abstract class AbstractCommonsException extends Exception
{
    /**
     * @var int|mixed
     */
    protected $code;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected string $file;

    /**
     * @var int
     */
    protected int $line;

    /**
     * @var array
     */
    protected $trace;

    /**
     * @var Exception
     */
    protected $originalException;

    /**
     * AbstractCoreException constructor.
     */
    public function __construct() {
        $args = func_get_args();

        //  We will come back here later!!
        //dd($args);
    }
}
