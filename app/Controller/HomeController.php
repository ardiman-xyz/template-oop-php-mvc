<?php

namespace Ardiman\BelajarPhpMvc\Controller;

use Ardiman\BelajarPhpMvc\App\View;

class HomeController
{

    public function index(): void
    {
        $model = [
            "title"     => "PHP Login Manajement",
            "content"   => "selamat datang di course belajar PHP MVC"
        ];

        View::render("Home/index", $model);
    }
}
