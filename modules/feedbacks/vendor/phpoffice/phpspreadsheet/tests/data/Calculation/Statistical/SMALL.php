<?php

return [
    [
        3,
        [1, 4, 8, 3, 7, 12, 54, 8, 23],
        2,
    ],
    [
        4,
        [3, 4, 5, 2, 3, 4, 6, 4, 7],
        4,
    ],
    [
        6,
        ['3', 4, 5, '2', '3', 4, 5, 6, 4, 7],
        6,
    ],
    [
        '#VALUE!',
        [3, 4, 5, 2, 3, 4, 5, 6, 4, 7],
        'NAN',
    ],
    [
        '#NUM!',
        [3, 4, 5, 2, 3, 4, 5, 6, 4, 7],
        -1,
    ],
    [
        '#NUM!',
        [],
        1,
    ],
];
