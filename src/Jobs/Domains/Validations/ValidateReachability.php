<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use Iodev\Whois\Exceptions\ConnectionException;
use Iodev\Whois\Exceptions\ServerMismatchException;
use Iodev\Whois\Exceptions\WhoisException;
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

        //  Check if the domain is registered
        $isRegistered = $this->checkDomainIsRegistered();

        if($isRegistered)
            $this->setProgress(33, 'We validate that the domain is registered');
        else
            $this->setProgress(33, 'We validate that the domain is not registered.');

        // Check if the domain is reachable
        $isReachable = $this->checkDomainIsReachable();

        if($isReachable)
            $this->setProgress(66, 'We validate domain if it is reachable');
        else
            $this->setProgress(66, 'We validate domain if it is not reachable.');

        // Refresh the Validatables record to reflect the latest changes

        $this->validatable->refresh();

        // If domain is registered and reachable, generate and store a token

        if($this->validatable['validation_data']['is_reachable']){
            $this->model->update([
                'is_reachable' => true,
            ]);
        }

        $this->setProgress(100, 'Validating domain action completed');
    }


    /**
     * This method checks if the domain is registered and not expired. It uses the Iodev\Whois package to check the domain.
     *
     * It returns true if the domain is registered and false if it is not.
     *
     * @return bool
     * @throws \Iodev\Whois\Exceptions\ConnectionException
     * @throws \Iodev\Whois\Exceptions\ServerMismatchException
     * @throws \Iodev\Whois\Exceptions\WhoisException
     */
    private function checkDomainIsRegistered() : bool {
        try {
            $whois = Factory::get()->createWhois();
            $url = $this->model->name;
            $info = $whois->loadDomainInfo($url);
            if($info){
                $this->validatable->update([
                    'validation_data'   =>  [
                        'is_registered' => true,
                    ],
                ]);

                return true;
            }else{
                $this->validatable->update([
                    'validation_data'   =>  [
                        'is_registered' => false,
                    ],
                ]);

                return false;
            }
        } catch (ConnectionException $exception) {
            //  @todo: Log the exception and return false

        } catch (ServerMismatchException $exception) {
            //  @todo: Log the exception and return false

        } catch (WhoisException $exception) {
            //  @todo: Log the exception and return false

        }

        return false;
    }


    /**
     * This method checks if the domain is reachable. It uses the curl to check the domain.
     *
     * @return bool
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
            $this->validatable->update([
                'validation_data'   =>  [
                    'is_reachable' => true,
                ],
            ]);
            return true;
        } else {
            $this->validatable->update([
                'validation_data'   =>  [
                    'is_reachable' => false,
                ],
            ]);
            // Domain is not reachable
            return false;
        }
    }

    public function fail($exception = null){
        dd($exception);
    }
}
