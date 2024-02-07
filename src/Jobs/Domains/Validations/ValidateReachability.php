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
    }






    /**
     * Checks if the domain is reachable and registered
     */

    public function handle()
    {
        Log::info("Validating domain action started for: ". $this->model->name);

        //  Application starts here
        // $this->setProgress(0, 'Validating domain action started');

        if($this->checkDomainIsReachable()) {
            $validationData['is_reachable'] = true;
            $this->validatable->update([
                'validation_data'   =>  $validationData,
            ]);

            // $this->setProgress(66, 'We validate domain if it is reachable');
            Log::info("We validate domain that it is reachable");
        } else {
            $validationData['is_reachable'] = false;
            $this->validatable->update([
                'validation_data'   =>  $validationData,
            ]);
            // $this->setProgress(66, 'We cannot validate domain if it is reachable');
            Log::info("We cannot validate domain if it is reachable");
        }

        if ($this->checkDomainIsRegistered()){

            // $this->setProgress(33, 'We validate domain if it is registered');
            $validationData['is_registered'] = true;
            $this->validatable->update([
                'validation_data'   =>  $validationData,
            ]);
            Log::info("We validate domain if it is registered");

        } else {

            $validationData['is_registered'] = false;
            $this->validatable->update([
                'validation_data'   =>  $validationData,
            ]);

            // $this->setProgress(33, 'We cannot validate domain if it is registered');
            Log::info("We validate domain if it is registered");
        }


        $this->validatable->refresh();

        if($validationData['is_registered'] && $validationData['is_reachable']){
            Log::info("isRegistered");
            $this->model->is_reachable = true;
            $this->model->save();
        }

        // $this->setProgress(100, 'Validating domain action completed');
        Log::info("Validating domain action completed");

        //  Application ends here
    }



     /**
     *
     * checks if the domain is registered and not expired
     */
    private function checkDomainIsRegistered() : bool {
        $whois = Factory::get()->createWhois();
        $info = $whois->loadDomainInfo("loupp.io");
        if($info){
            if(date('Y-m-d') > date("Y-m-d", $info->expirationDate)){
                return false;
            }else{
                return true;
            }
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
}
