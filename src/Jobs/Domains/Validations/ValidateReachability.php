<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\Commons\Database\Models\Validatables;

/**
 * This action validates the domain by using http(s) protocol. It will check if the domain is reachable.
 */
class ValidateReachability extends AbstractAction
{
    public $domain = null;

    public $validatable = null;

    /**
     * @todo: Write comments
     *
     * @param Domains $domain
     */
    public function __construct(Domains $domain)
    {
        $this->domain = $domain;

        $this->validatable = Validatables::create([
            'domain_id' => $domain->id,
            'validation_type' => 'reachability',
        ]);
    }

    public function handle()
    {
        /**
         * This will check if the domain is reachable
         */
        $url = $this->domain->url;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpCode;
    }

    private function checkDomainIsRegistered() : bool {

    }

    private function checkDomainIsReachable() : bool {

    }
}
