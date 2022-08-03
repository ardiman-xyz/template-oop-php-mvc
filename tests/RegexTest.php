<?php

namespace Ardiman\BelajarPhpMvc;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class RegexTest extends TestCase
{

    public function testRegex()
    {
        $path = "/products/12345/categories/adasd";

        $pattern = "#^/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)$#";

        $result = preg_match($pattern, $path, $variables);
        assertEquals(1, $result);

        array_shift($variables);
        var_dump($variables);
    }
}
