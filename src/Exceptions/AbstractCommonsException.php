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
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Http\Traits\Responsable;
use NextDeveloper\I18n\Helpers\i18n;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
 * Class AbstractCoreException.
 *
 * @package  NextDeveloper\Commons\Exceptions
 */
abstract class AbstractCommonsException extends Exception
{
    use Responsable;

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
    public function __construct($message, $code = 0, \Exception $previous = null) {
        $args = func_get_args();

        $this->message = $message;

        parent::__construct($message, $code, $previous);
    }

    /**
     *  Render the exception into an HTTP response.
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request = null)
    {
        $returnMessage = $this->defaultMessage;

        $me = UserHelper::me();

        if($me)
            $returnMessage = I18n::t($returnMessage, $me->common_language_id);

        Log::error('[EXCEPTION] ' . $returnMessage . ' - ' . $this->message);

        $translate = true;

        if(!$me)
            $translate = false;

        return $this->setStatusCode(422)->withArray([
            'status'    =>  422, // 'Unprocessable Entity'
            'message'   =>  $returnMessage,
            'helper'    =>  $translate ? I18n::t($this->message, $me->common_language_id) : $this->message,
            'code'      =>  $this->code,
        ]);
    }
}
