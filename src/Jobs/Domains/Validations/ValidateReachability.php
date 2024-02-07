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
    public $model = null;

    public $validatable = null;

    /**
     * @todo: Write comments
     *
     * @param Domains $domain
     */
    public function __construct(Domains $model)
    {
        $this->model = $model;

        $this->validatable = Validatables::create([
            'object_id' => $model->id,
            'object_type' => get_class($model),
            'validation_data'   =>  [
                'is_registered' => false,
                'is_reachable'  => false,
            ]
        ]);
    }

    public function handle()
    {
        //  Application starts here
        $this->setProgress(0, 'Validating domain action started');

        if ($this->checkDomainIsRegistered()) {
            $this->setProgress(33, 'We validate domain if it is registered');
            $this->validatable->update([
                'validation_data'   =>  [
                    'is_registered' => false,
                ],
            ]);
        } else {
            $this->validatable->update([
                'is_registered' => false
            ]);

            $this->setProgress(33, 'We cannot validate domain if it is registered');
        }

        if($this->checkDomainIsReachable()) {
            $this->validatable->update([
                'validation_data'   =>  [
                    'is_registered' => true,
                ],
            ]);
            $this->setProgress(66, 'We validate domain if it is reachable');
        } else {
            $this->validatable->update([
                'validation_data'   =>  [
                    'is_registered' => false,
                ],
            ]);
            $this->setProgress(66, 'We cannot validate domain if it is reachable');
        }

        $this->validatable = $this->validatable->fresh();

        if($this->validatable->is_registered && $this->validatable->is_reachable) {
            $this->model->update([
                'is_reachable' => true,
            ]);
        }

        $this->setProgress(100, 'Validating domain action completed');
        //  Application ends here
    }

    private function checkDomainIsRegistered() : bool {
        // Create a new instance of the Whois class
        $whois = new Whois();

        // Perform the WHOIS query for the specified domain
        $result = $whois->lookup($this->model->name);

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
