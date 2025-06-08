<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\Countries;

class CountryHelper
{
    public static function getCountryById($id) : ?Countries
    {
        if(Str::isUuid($id)) {
            return Countries::where('uuid', $id)->first();
        }

        return Countries::where('id', $id)->first();
    }

    public static function getCountry($object) : ?Countries {
        if(isset($object->common_country_id)) {
            return Countries::where('id', $object->common_country_id)->first();
        }

        return null;
    }
}
