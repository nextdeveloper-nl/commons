<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\Validatables;


/**
 * This action validates the domain by using http(s) protocol. It will check if the domain is ownership by
 * looking at the server if the designated file is there with the given content.
 */
class ValidateOwnershipWithHttp extends AbstractAction
{
    public $model = null;


    /**
     * @todo: Write comments
     *
     * @param Domains $model
     * 
     */
    public function __construct(Domains $model)
    {
        $this->model = $model; // Assign the provided Domains model to $this->model

    }


    /**
     * Handle the job.
     *
     * @return void
     */
    public function handle()
    {
        // Set progress to 0% and start checking the domain
        $this->setProgress(0, 'Checking domain');

        if ($this->model) {
            $validatable = Validatables::where('object_id', $this->model->id)
                                    ->where('object_type', get_class($this->model))
                                    ->first();
            if($validatable && $this->model->is_reachable){

                // Set progress to 50% and start checking the domain ownership
                $this->setProgress(50, 'Checking domain ownership');

                // Get the domain's DNS token
                $domainDnsToken = $validatable->validation_data['dns_token'];

                $checkDnsRecords = dns_get_record($this->model->name, TXT);
                if ($checkDnsRecords !== false) {
                    foreach ($checkDnsRecords as $record) {
                        // Display each TXT record found
                        if($record['txt'] == $domainDnsToken){
                            // Set progress to 100% and indicate that the domain was found and validated
                            $this->setProgress(100, 'Domain found and Ownership Validated');
                        }else{
                            // Set progress to 100% and indicate that the domain was found but not validated
                            $this->setProgress(100, 'Domain found but not validated');
                        }
                    }
                } else {

                    // No TXT records found for the domain
                    echo "No TXT records found for the domain.\n";
                    $this->setProgress(100, 'Domain found but No TXT records found for the domain');

                }

                
            }else{
                //Set progress to 100% and indicate that the domain was found but not reachable
                $this->setProgress(100, 'Domain found but not reachable');

            }

            
            // Set progress to 100% and indicate that the domain was found and validated
            $this->setProgress(100, 'Domain found and validated');
        }else{
            // Set progress to 100% and indicate that the domain was not found
            $this->setProgress(100, 'Domain not found');
        }
        

        
    }

}