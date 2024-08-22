<?php

namespace NextDeveloper\Commons\Helpers;

class ActionsHelper
{
    public static function saveInDb() : bool {
        return config('commons.configuration.actions.save_in_db');
    }
}