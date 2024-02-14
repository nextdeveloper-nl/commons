<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\IAM\Services\UsersService;

/**
 * This action validates the domain by using http(s) protocol. It will check if the domain is ownership by
 * looking at the server if the designated file is there with the given content.
 */
class SendValidationEmail extends AbstractAction
{
    public $model = null;
    public $email = null;

    /**
     * @todo: Write comments
     *
     * @param Domains $domain
     *
     * @param string $email [validate:string|email|required|in:hostmaster,webmaster,postmaster,administrator,admin,sysadmin]
     */
    public function __construct(Domains $model, $email )
    {
        $this->model = $model; // Assign the provided Domains model to $this->model

        parent::__construct(); // Call the constructor of the parent class
    }

    /**
     * Handle the job.
     *
     * @return void
     */
    public function handle()
    {
        // Set progress to 0% and start sending out email for domain ownership verification
        $this->setProgress(0, 'Sending out email for domain ownership verification');

        // Check if the domain exists
       if($this->model){
 
            // Create a user and associate it with the master user
            $email = $this->email."@".$this->model->name;
            $user = UsersService::createWithEmail($email);

            $masterAccount = UserHelper::getAccountById($this->model->iam_account_id);
            UserHelper::addUserToAccount($user, $masterAccount);

            // Set progress to 100% and indicate that the email for domain ownership verification has been sent
            $this->setProgress(100, 'Email sent for domain ownership verification');

       }else{
            // If the domain doesn't exist, set progress to 100% and indicate that the domain was not found
            throw new \Exception('Domain not found');
       }
    }

}