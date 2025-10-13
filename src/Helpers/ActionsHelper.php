<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\Actions;

class ActionsHelper
{
    public static function saveInDb() : bool {
        return config('commons.configuration.actions.save_in_db');
    }

    public static function logInFile() : bool {
        return config('commons.configuration.actions.log_in_file');
    }

    public static function getActionWithId($id)
    {
        if(Str::isUuid($id))
            return Actions::withoutGlobalScopes()->where('uuid', $id)->first();

        return Actions::withoutGlobalScopes()->where('id', $id)->first();
    }
}
