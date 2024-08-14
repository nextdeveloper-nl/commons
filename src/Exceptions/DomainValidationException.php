<?php

namespace NextDeveloper\Commons\Exceptions;

use Exception;

class DomainValidationException extends Exception
{
    public function __construct(string $domain)
    {
        parent::__construct("The domain '$domain' is not a fully qualified domain name ");
    }
}