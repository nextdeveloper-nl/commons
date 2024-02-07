<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\Commons\Database\Models\Validatables;
use phpWhois\Whois;


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
         * This will check if the domain is reachable && regsitered
         */

        if($this->checkDomainIsRegistered && $this->checkDomainIsReachable) {

            return true;
        } else {
            return false;
        }
        
    }

    private function checkDomainIsRegistered() : bool {
        // Create a new instance of the Whois class
        $whois = new Whois();
        
        // Perform the WHOIS query for the specified domain
        $result = $whois->lookup($this->domain);

        // Check the result to determine the registration status
        if ($result['regrinfo']['registered'] === true) {
            // Domain is registered
            return true;
        } else {
            // Domain is not registered
            return false;
        }

    }

    private function checkDomainIsReachable() : bool {

        $url = $this->domain->url;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            // Domain is reachable
            return true;
        } else {
            // Domain is not reachable
            return false;
        }
    }
}
