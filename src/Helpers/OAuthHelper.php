<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Support\Facades\DB;

class OAuthHelper
{
    private $_clientId;

    private $_client;

    public function __construct($clientId) {
        $this->_clientId = $clientId;

        $this->_client = DB::table('oauth_clients')
            ->select('*')
            ->where('id', $clientId)
            ->first();
    }

    public function checkClient() {
        if(!$this->_client)
            return false;

        return true;
    }

    public function checkReturnUrl($redirectUri) {
        if($this->_client->redirect == $redirectUri)
            return true;

        return false;
    }
}