<?php
use PHPUnit\Framework\TestCase;

const BRACE_PAIR = [
    '(' => ')',
    '{' => '}',
    '[' => ']'
];

function delGoodBraces(array $braces) {
    foreach ($braces as $key => $brace) {
        if (isset($braces[$key + 1]) && isset(BRACE_PAIR[$brace])) {
            if ($braces[$key + 1] === BRACE_PAIR[$brace]) {
                array_splice($braces, $key, 2);
                return delGoodBraces($braces);
            }
        }
    }

    return count($braces) === 0;
}

function validBraces($braces) {
    $bracesArr = str_split($braces);
    if (count($bracesArr) % 2 !== 0) return false;

    return delGoodBraces($bracesArr);
}

class ValidBracesTest extends TestCase
{
    public function testSamples() {
        $this->assertSame(false, validBraces(""));
        $this->assertSame(true, validBraces("()"));
        $this->assertSame(false, validBraces("(}"));
        $this->assertSame(false, validBraces("[(])"));
        $this->assertSame(true, validBraces("()[]{}"));
        $this->assertSame(true, validBraces("([{}])"));
        $this->assertSame(false, validBraces("[({})](]"));
        $this->assertSame(true, validBraces("[({})]([])"));
    }
}