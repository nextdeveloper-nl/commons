<?php

namespace NextDeveloper\Commons\Helpers;

class RandomHelper
{
    /**
     * This function generates random uuid and returns
     *
     * @param $min
     * @param $max
     * @return string
     */
    public static function uuid() : string
    {
        $data = openssl_random_pseudo_bytes(16, $strong);

        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}