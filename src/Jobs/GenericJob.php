<?php

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenericJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $_obj;

    private $_method;

    private $_params;

    public function __construct($obj, $method, array $params) {
        $this->_obj = $obj;
        $this->_method = $method;
        $this->_params = $params;
    }

    public function handle() {
        Log::info('[GenericJob@handle] Starting a generic job ..');

        //  handle errors
        try{
            call_user_func([
                $this->_obj,
                $this->_method
            ], $this->_params);
        } catch(\Exception $e) {
            Log::error('[GenericJob@handle] Generic job catches an error.');

        }
    }
}
