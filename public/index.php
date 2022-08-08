<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Ardiman\BelajarPhpMvc\App\Router;
use Ardiman\BelajarPhpMvc\Config\Database;
use Ardiman\BelajarPhpMvc\Controller\HomeController;
use Ardiman\BelajarPhpMvc\Controller\UserController;

Database::getConnection("prod");

Router::add('GET', '/logo', HomeController::class, 'index', []);
Router::add('GET', '/users/register', UserController::class, 'register', []);
Router::add('POST', '/users/register', UserController::class, 'postRegister', []);
Router::add('GET', '/users/login', UserController::class, 'login', []);

Router::run();
