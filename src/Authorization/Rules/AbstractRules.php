<?php

namespace NextDeveloper\Commons\Authorization\Rules;

use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\IAM\Database\Models\Users;

interface AbstractRules
{
    public static function get(Users $users) : bool;

    public static function create(Users $users) : bool;

    public static function update(Users $users) : bool;

    public static function delete(Users $users) : bool;

    public static function can(Users $users) : bool;

    public static function run(AbstractAction $action, Users $users) : bool;
}
