<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Ardiman\BelajarPhpMvc\App\Router;
use Ardiman\BelajarPhpMvc\Controller\HomeController;

Router::add('GET', '/', HomeController::class, 'index', []);

Router::run();
