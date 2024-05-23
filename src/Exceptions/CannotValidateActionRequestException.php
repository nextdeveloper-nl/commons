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
class CannotValidateActionRequestException extends AbstractCommonsException
{
        /**
        * @var string
        */
        protected $defaultMessage = 'We cannot validate the parameters of action you want to run.' .
        ' Most probably, you are providing wrong type of data or a data that is actually not available' .
        ' or you dont have the right privilege to access that data. Please check the data you' .
        ' are providing and try again.';

        /**
        * @param $message
        * @param $code
        * @param \Exception|null $previous
        */
        public function __construct(array $errors, $code = 0, \Exception $previous = null)
        {
            $message = '';

            foreach ($errors as $error) {
                $message .= $error . ', ';
            }

            $message = $this->defaultMessage . 'Error message is: ' . $message;

            parent::__construct($message, $code, $previous);
        }
}
