<?php

// Cost, Date purchased, End of the 1st period, Salvage, Period, Depreciation, Basis, Result

return [
    [
        360,
        2400, '2008-08-19', '2008-12-31', 300, 1, 0.15, 1,
    ],
    [
        576,
        2400, '2008-08-19', '2008-12-31', 300, 2, 0.24, 1,
    ],
    [
        576,
        2400, '2008-08-19', '2008-12-31', 300, 2, 0.24, 0,
    ],
    [
        576,
        2400, '2008-08-19', '2008-12-31', 300, 2, 0.24, null,
    ],
    [
        30,
        150, '2011-01-01', '2011-09-30', 20, 1, 0.2, 4,
    ],
    [
        22.41666667,
        150, '2011-01-01', '2011-09-30', 20, 0, 0.2, 4,
    ],
    [
        17.58333333,
        150, '2011-01-01', '2011-09-30', 20, 4, 0.2, 4,
    ],
    [
        0.0,
        150, '2011-01-01', '2011-09-30', 20, 5, 0.2, 4,
    ],
    [
        '#VALUE!',
        'NaN', '2011-01-01', '2011-09-30', 20, 1, 0.2, 4,
    ],
    [
        '#VALUE!',
        150, '2011-01-01', 'notADate', 20, 1, 0.2, 4,
    ],
    [
        '#VALUE!',
        150, 'notADate', '2011-09-30', 20, 1, 0.2, 4,
    ],
    [
        '#VALUE!',
        150, '2011-01-01', '2011-09-30', 'NaN', 1, 0.2, 4,
    ],
    [
        '#VALUE!',
        150, '2011-01-01', '2011-09-30', 20, 'NaN', 0.2, 4,
    ],
    [
        '#VALUE!',
        150, '2011-01-01', '2011-09-30', 20, 1, 'NaN', 4,
    ],
    [
        '#VALUE!',
        150, '2011-01-01', '2011-09-30', 20, 1, 0.2, 'NaN',
    ],
    [
        '#NUM!',
        550, '2012-03-01', '2020-12-25', 20, 1, 0.2, 99,
    ],
];
