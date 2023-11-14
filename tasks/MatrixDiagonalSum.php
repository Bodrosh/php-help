<?php

function sumDiagonalMatrix(array $matrix): int {
    $sum = 0;
    $length = count($matrix);

    foreach ($matrix as $keyRow => $row) {
        $sum += $row[$keyRow];
        $sum += $row[$length - ($keyRow + 1)];
    }

    return $sum;
}

$matrix = [
    [1, 2, 3, 4],
    [4, 5, 6, 5],
    [7, 8, 9, 6],
    [8, 8, 9, 1],
];

var_dump(sumDiagonalMatrix($matrix));