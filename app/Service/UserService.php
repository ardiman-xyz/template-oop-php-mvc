<?php

namespace Ardiman\BelajarPhpMvc\Service;

use Ardiman\BelajarPhpMvc\Config\Database;
use Ardiman\BelajarPhpMvc\Domain\User;
use Ardiman\BelajarPhpMvc\Exception\ValidationException;
use Ardiman\BelajarPhpMvc\Model\UserRegisterRequest;
use Ardiman\BelajarPhpMvc\Model\UserRegisterResponse;
use Ardiman\BelajarPhpMvc\Repository\UserRepository;
use Exception;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);

        $user = $this->userRepository->findById($request->id);

        if ($user !== null) {
            throw new ValidationException("user already exist");
        }

        try {

            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;

            return $response;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        if (
            $request->id === null || $request->name === null || $request->password === null ||
            trim($request->id) === "" || trim($request->name) === "" || trim($request->password) === ""
        ) {
            throw new ValidationException("field id, user, password is required!");
        }
    }
}
