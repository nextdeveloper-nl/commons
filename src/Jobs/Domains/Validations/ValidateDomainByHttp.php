<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\IAM\Database\Models\Users;

/**
 * This action validates the domain by using http(s) protocol. It will check if the domain is ownership by
 * looking at the server if the designated file is there with the given content.
 */

class ValidateDomainByHttp extends AbstractAction
{
    public $model = null;

    
    /**
     * __construct
     * 
     * @param  Domains $model
     * 
     * @param string $url [validate:url|required|]
     */
    public function __construct(Domains $model, $url)
    {
        $this->model = $model; // Assign the provided Domains model to $this->model
        $this->url = $url;   // Assign the provided URL of where user uploaded file to $this->url
        parent::__construct();
    }


    
    /**
     * handle
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
                $this->setProgress(50, 'Checking domain ownership with HTTP');
                $get_token = file_get_contents($this->url);
                $domain_token = $validatable->validation_data['token'];
                if($get_token !== null && $get_token === $domain_token){
                    $this->model->update([
                        'is_validated' => true
                    ]);
                    $this->setProgress(100, 'Domain ownership validated');
                }else{
                    $this->setProgress(100, 'Domain ownership not validated');
                }
            }else{
                //Set progress to 100% and indicate that the domain was found but not reachable
                $this->setProgress(100, 'Domain found but not reachable');
            }
        }else{
            //Set progress to 100% and indicate that the domain was not found
            $this->setProgress(100, 'Domain not found');
        }

    }

}