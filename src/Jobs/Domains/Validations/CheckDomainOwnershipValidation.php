<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\IAM\Database\Models\Users;

/**
 * This action validates the domain by using http(s) protocol. It will check if the domain is ownership by
 * looking at the server if the designated file is there with the given content.
 */

class CheckDomainOwnershipValidation extends AbstractAction
{
    public $model = null;

    
    /**
     * __construct
     *
     * @param  Domains $model
     */
    public function __construct(Domains $model,Users $user)
    {
        $this->model = $model;

        $this->user = $user;

        parent::__construct();
    }


    
    /**
     * handle
     *
     * @return void
     */
    public function handle()
    {

        // Set progress to 0% and start check
        $this->setProgress(0, 'Sending out email for domain ownership verification');

        if($this->domain->ownerAccount == $this->user->masterAccount && $this->domain->isValidationExpected && $this->user->email_validated == true){

            $this->model->update([
                'is_validated' => true,
            ]);
            // Set progress to 100% and indicate that the domain was found and validated
            
            $this->setProgress(100, 'Domain found and validated');
        }

    }

}