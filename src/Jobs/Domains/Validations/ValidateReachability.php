<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\Commons\Database\Models\Validatables;
use Illuminate\Support\Facades\Log;
use Iodev\Whois\Factory;


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

        parent::__construct();
    }

    /**
     * Checks if the domain is reachable and registered
     *
     * @return void
     */
    public function handle()
    {
        //  Application starts here
        $this->setProgress(0, 'Validating domain action started');

        // Check if the domain is reachable

        if($this->checkDomainIsReachable()) {
            $validationData['is_reachable'] = true;
            $this->validatable->update([
                'validation_data'   =>  $validationData,
            ]);

            $this->setProgress(66, 'We validate domain if it is reachable');
        } else {
            $validationData['is_reachable'] = false;
            $this->validatable->update([
                'validation_data'   =>  $validationData,
            ]);
            $this->setProgress(66, 'We cannot validate domain if it is reachable');
        }

        // Check if the domain is registered

        if ($this->checkDomainIsRegistered()){

            $this->setProgress(33, 'We validate domain if it is registered');
            $validationData['is_registered'] = true;
            $this->validatable->update([
                'validation_data'   =>  $validationData,
            ]);

        } else {

            $validationData['is_registered'] = false;
            $this->validatable->update([
                'validation_data'   =>  $validationData,
            ]);

            $this->setProgress(33, 'We cannot validate domain if it is registered');
        }

        // Refresh the Validatables record to reflect the latest changes

        $this->validatable->refresh();

        // If domain is registered and reachable, generate and store a token

        if($validationData['is_registered'] && $validationData['is_reachable']){
            $this->model->is_reachable = true;
            $this->model->save();
        }

        $this->setProgress(100, 'Validating domain action completed');
    }



     /**
     *
     * checks if the domain is registered and not expired
     */
    private function checkDomainIsRegistered() : bool {
        $whois = Factory::get()->createWhois();
        $url = $this->model->name;
        $info = $whois->loadDomainInfo($url);
        if($info){
            return true;
        }else{
            return false;
        }

    }


    /**
     * Checks if domain is reachable
     */

    private function checkDomainIsReachable() : bool {

        $url = $this->model->name;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);


        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        Log::info($httpCode);
        if ($httpCode === 200) {
            // Domain is reachable
            return true;
        } else {
            // Domain is not reachable
            return false;
        }
    }

    public function fail($exception = null){
        dd($exception);
    }
}
