<?php

namespace NextDeveloper\Commons\Services\Traits;

use Illuminate\Support\Facades\Log;

trait BackgroundProcess
{
    private $isBackground = false;

    public function __call($method, array $params) {
        if($this->isBackground) {
            Log::info('[BackgroundProcess@__call] Running this method: ' . $method . ' in background'
                . ' process.');

            $this->executeInBackground($method, $params);

            return null;
        }

        return call_user_func([
            $this,
            $method
        ],
        $params);
    }

    public function runInBackground() {
        $this->isBackground = true;
    }

    private function executeInBackground($method, array $params) {

    }
}
