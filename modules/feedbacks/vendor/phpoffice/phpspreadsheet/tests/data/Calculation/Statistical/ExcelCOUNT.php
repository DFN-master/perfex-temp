<?php

return [
    'passing range do not count bool, null, or text numbers' => [
        3,
        [
            // The index simulates a cell value
            '0.1.A' => 'A',
            '0.2.A' => 1,
            '0.3.A' => true,
            '0.4.A' => 2.9,
            '0.5.A' => false,
            '0.6.A' => '3',
            '0.7.A' => '',
            '0.8.A' => null,
            '0.9.A' => 9,
        ],
    ],
    'passing values - count null, boolean and text numbers' => [
        7,
        // No index indicates arguments passed as literals rather than cell values
        // In this case, booleans are counted as well as numbers, as are numeric-value string literals
        'A',
        1,
        true,
        2.9,
        false,
        '3',
        '',
        null,
        9,
    ],
];
