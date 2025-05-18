<?php

namespace NextDeveloper\Commons\Helpers;

use NextDeveloper\Commons\Database\Models\Countries;

class CountryHelper
{
    public static function getCountry($object) : ?Countries {
        if(isset($object->common_country_id)) {
            return Countries::where('id', $object->common_country_id)->first();
        }

        return null;
    }
}
