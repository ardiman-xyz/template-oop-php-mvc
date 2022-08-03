<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Ardiman\BelajarPhpMvc\App\Router;
use Ardiman\BelajarPhpMvc\Controller\HomeController;
use Ardiman\BelajarPhpMvc\Controller\ProductController;

Router::add("GET", '/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)', ProductController::class, 'categories');

Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/hello', HomeController::class, 'hello');

Router::run();
