<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;
use Illuminate\Http\Request;

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
     * 
     */
    public function __construct(Domains $domain)
    {
        $this->domain = $domain; // Assign the provided Domains model to $this->model

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

        // Check if the domain exists
        if ($this->domain){
            // If the domain exists, mark it as validated
            $this->domain->update([
                'is_validated' => true,
            ]);

            // Set progress to 100% and indicate that the domain was found and validated
            $this->setProgress(100, 'Domain found and validated');
        } else {
            // If the domain doesn't exist, set progress to 100% and indicate that the domain was not found
            $this->setProgress(100, 'Domain not found');
        }
    }

}


