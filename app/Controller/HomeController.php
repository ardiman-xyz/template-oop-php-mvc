<?php

namespace Ardiman\BelajarPhpMvc\Controller;

use Ardiman\BelajarPhpMvc\App\View;

class HomeController
{

    public function index(): void
    {
        $model = [
            "title"     => "Belajar PHP MVC",
            "content"   => "selamat datang di course belajar PHP MVC"
        ];

        View::render("Home/index", $model);
    }

    public function hello(): void
    {
        echo "HomeController.hello()";
    }
}
