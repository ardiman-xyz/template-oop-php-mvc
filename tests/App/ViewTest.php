<?php

namespace Ardiman\BelajarPhpMvc\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{

    public function testRender()
    {
        View::render("Home/index", [
            "PHP Login Manajement"
        ]);

        $this->expectOutputRegex('[PHP Login Manajement]');
        $this->expectOutputRegex('[Login Manajement]');
        $this->expectOutputRegex('[Ardiman]');
        $this->expectOutputRegex('[body]');
        $this->expectOutputRegex('[html]');
        $this->expectOutputRegex('[Register]');
        $this->expectOutputRegex('[Login]');
    }
}
