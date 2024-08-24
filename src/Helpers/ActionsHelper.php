<?php

namespace NextDeveloper\Commons\Helpers;

class ActionsHelper
{
    public static function saveInDb() : bool {
        return config('commons.configuration.actions.save_in_db');
    }

    public static function logInFile() : bool {
        return config('commons.configuration.actions.log_in_file');
    }
}
