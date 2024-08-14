<?php

namespace NextDeveloper\Commons\Helpers;
use Arubacao\TldChecker\Validator;

class DomainsHelper
{
    /**
     * Checks if a given domain string is a Fully Qualified Domain Name
     * @param string $domain
     * @return bool
     */
    public static function isFQDN(string $domain): bool
    {
        return Validator::endsWithTld($domain);
    }

    public static function allowNonFqdn() : bool {
        return config('commons.configuration.domains.allow_non_fqdn');
    }
}
