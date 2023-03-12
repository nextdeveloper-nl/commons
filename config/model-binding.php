<?php

return [
    'country' => function ($value) {
        return NextDeveloper\Commons\Database\Models\Country::findByRef($value);
    },

//!APPENDHERE
];