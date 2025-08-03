<?php

namespace NextDeveloper\Commons\Macros;

use Illuminate\Support\Str;

/**
 * This code is partially taken from https://github.com/victoryoalli/laravel-string-macros
 *
 * Thank you @KoenHendriks for the inspiration.
 */

class ReadMinutes
{
    public const NAME = 'readMinutes';

    public function __invoke()
    {
        /**
         * The developer Victor assumed that the average reading speed is 200 words per minute. However this can
         * change so you can change the parameter also
         */
        return function ($subject, $wordsPerMinute = 200) {
            return intval(ceil(Str::wordCount(strip_tags($subject)) / $wordsPerMinute));
        };
    }
}
