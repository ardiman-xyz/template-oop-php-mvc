<?php

namespace Ardiman\BelajarPhpMvc\App;

class View
{

    public static function render(string $view, $model = null): void
    {
        require __DIR__ . "/../View/" . $view . ".php";
    }
}
