<?php

namespace NextDeveloper\Commons\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use NextDeveloper\CRM\Database\Models\Users;

class AbstractAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $jobId;

    /**
     * This action takes a user object and assigns an Account Manager
     *
     * @param Users $users
     */
    public function __construct()
    {

    }

    public function setProgress($percent, $competedAction) {

    }
}
