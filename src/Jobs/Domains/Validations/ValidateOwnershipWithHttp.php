<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;

/**
 * This action validates the domain by using http(s) protocol. It will check if the domain is ownership by
 * looking at the server if the designated file is there with the given content.
 */
class ValidateOwnershipWithHttp extends AbstractAction
{
    public $domain = null;

    /**
     * @todo: Write comments
     *
     * @param Domains $domain
     */
    public function __construct(Domains $domain)
    {
        $this->domain = $domain;
    }

    public function handle(){

    }
}
