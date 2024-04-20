<?php

namespace NextDeveloper\Commons\Macros;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * This code is partially taken from https://github.com/victoryoalli/laravel-string-macros
 *
 * Thank you @KoenHendriks for the inspiration.
 */

/**
 * This macro basicly returns the number of lines in a string.
 */
class LineCount
{
    public const NAME = 'lineCount';

    public function __invoke()
    {
        return function ($subject) {
            $lines = preg_split('/\n|\r/', $subject);

            return count($lines);
        };
    }
}
