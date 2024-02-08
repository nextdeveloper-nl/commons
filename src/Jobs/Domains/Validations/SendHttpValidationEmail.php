<?php

namespace NextDeveloper\Commons\Jobs\Domains\Validations;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\Domains;

/**
 * This action validates the domain by using http(s) protocol. It will check if the domain is ownership by
 * looking at the server if the designated file is there with the given content.
 */
class SendHttpValidationEmail extends AbstractAction
{
    public $domain = null;
    public $email = null;

    /**
     * @todo: Write comments
     *
     * @param Domains $domain
     * 
     * @param string $email [validate:string|email|required]
     */
    public function __construct(Domains $domain, $email )
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
        // Set progress to 0% and start sending out email for domain ownership verification
        $this->setProgress(0, 'Sending out email for domain ownership verification');

        // Generate the verification link for the domain
        $link = "https://leo4.plusclouds.com/commons/domains/{$domain->uuid}";

        // Prepare the subject and message for the email
        $subject = I18n::t("Domain Ownership Verification");
        $message = I18n::t("Please verify your domain ownership by clicking the link below \n\n {$link}");

        // Retrieve the user associated with the domain
        $user = Users::where('id', $domain->iam_user_id)->first();

        // If user exists, send the email for domain ownership verification
        if ($user) {
            $user->sendEmail($subject, $message);
        }

        // Set progress to 100% and indicate that the email for domain ownership verification has been sent
        $this->setProgress(100, 'Email sent for domain ownership verification');
    }

}


