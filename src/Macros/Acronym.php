<?php

namespace NextDeveloper\Commons\Macros;

/**
 * This code is partially taken from https://github.com/koenhendriks/laravel-str-acronym
 *
 * Thank you @KoenHendriks for the inspiration.
 */

class Acronym
{
    public const NAME = 'acronym';

    public function __invoke()
    {
        return function ($string, $delimiter = '') {
            if (empty($string)) {
                return '';
            }

            $acronym = '';
            foreach (preg_split('/[^\p{L}]+/u', $string) as $word) {
                if(!empty($word)){
                    $first_letter = mb_substr($word, 0, 1);
                    $acronym .= $first_letter . $delimiter;
                }
            }

            return $acronym;
        };
    }
}
