<?php

namespace NextDeveloper\Commons\Http\Controllers\Timezones;

use DateTimeZone;
use NextDeveloper\Commons\Http\Controllers\AbstractController;

class TimezonesController extends AbstractController
{
    /**
     * Returns all timezone identifiers recognised by PHP and Laravel,
     * grouped by region (Africa, America, Asia, etc.) for easy consumption
     * by frontend selects and app configuration screens.
     *
     * GET /commons/timezones
     */
    public function index()
    {
        $grouped = [];

        foreach (DateTimeZone::listIdentifiers() as $tz) {
            $slash = strpos($tz, '/');

            // Timezones without a slash (UTC, GMT, etc.) go into a "General" group.
            $region = $slash !== false ? substr($tz, 0, $slash) : 'General';

            $grouped[$region][] = $tz;
        }

        ksort($grouped);

        return $this->withArray([
            'timezones' => $grouped,
        ]);
    }
}
