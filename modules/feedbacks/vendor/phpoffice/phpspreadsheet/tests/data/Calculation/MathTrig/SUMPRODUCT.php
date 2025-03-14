<?php

return [
    [
        29,
        [1, 2, 3],
        [5, 6, 4],
    ],
    [
        156,
        [[3, 4], [8, 6], [1, 9]],
        [[2, 7], [6, 7], [5, 3]],
    ],
    [
        70,
        [[1, 2], [3, 4]],
        [[5, 6], [7, 8]],
    ],
    ['#VALUE!', [1, 2], [5, 6, 4]], // mismatched dimensions
    [17, [1, 2, 3], [5, 'y', 4]],
    [17, [1, 2, 3], [5, 0, 4]],
    [19, [1, 2, 3], [5, 1, 4]],
    [145, [1, 2, 3], [5, 1, 4], [9, 8, 7]],
    [61, [1, 2, 3], [5, 1, 4], [9, 8, '="7"']], // string treated as 0
    [100, ['="1"', 2, 3], [5, 1, 4], [9, 8, 7]], // string treated as 0
    [100, [null, 2, 3], [5, 1, 4], [9, 8, 7]], // null treated as 0
    [100, [true, 2, 3], [5, 1, 4], [9, 8, 7]], // true treated as 0
    [61, [1, 2, 3], [5, 1, 4], [9, 8, true]], // true treated as 0
];
