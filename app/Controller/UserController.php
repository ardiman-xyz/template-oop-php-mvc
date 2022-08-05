<?php

namespace Ardiman\BelajarPhpMvc\Controller;

use Ardiman\BelajarPhpMvc\App\View;
use Ardiman\BelajarPhpMvc\Config\Database;
use Ardiman\BelajarPhpMvc\Exception\ValidationException;
use Ardiman\BelajarPhpMvc\Model\UserRegisterRequest;
use Ardiman\BelajarPhpMvc\Repository\UserRepository;
use Ardiman\BelajarPhpMvc\Service\UserService;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }

    public function register()
    {
        View::render('User/register', [
            'title' => 'Register new user',
        ]);
    }

    public function postRegister()
    {
        $request = new UserRegisterRequest();
        $request->id = $_POST['id'];
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];

        try {
            $this->userService->register($request);
            //redirect to users/login
            View::redirect("/users/login");
        } catch (ValidationException $validation) {
            View::render('User/register', [
                'title' => 'Register new user',
                'error' => $validation->getMessage()
            ]);
        }
    }
}
