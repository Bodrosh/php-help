<?php
use PHPUnit\Framework\TestCase;

define("ALPHABET", array_map(fn($item) => ++$item, array_flip(range('a', 'z'))));

function getSymbolPosition(string $symbol): string {
    return ALPHABET[$symbol] ?? '';
}

function alphabet_position(string $s): string {
    $res = [];
    foreach(str_split(strtolower($s)) as $symbol) {
        $pos = getSymbolPosition($symbol);
        if ($pos) $res[] = $pos;
    }
    return implode(' ', $res);
}

class AlphabetPositionTest extends TestCase {
    public function testFixed() {
        $this->assertSame('20 8 5 19 21 14 19 5 20 19 5 20 19 1 20 20 23 5 12 22 5 15 3 12 15 3 11', alphabet_position('The sunset sets at twelve o\' clock.'));
        $this->assertSame('20 8 5 14 1 18 23 8 1 12 2 1 3 15 14 19 1 20 13 9 4 14 9 7 8 20', alphabet_position('The narwhal bacons at midnight.'));
    }
}