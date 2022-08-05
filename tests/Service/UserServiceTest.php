<?php

namespace Ardiman\BelajarPhpMvc\Service;

use Ardiman\BelajarPhpMvc\Config\Database;
use Ardiman\BelajarPhpMvc\Model\UserRegisterRequest;
use Ardiman\BelajarPhpMvc\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $userRepository->deleteAll();
    }

    public function testRegisterSuccess()
    {
        $request = new UserRegisterRequest();
        $request->id = "ardiman";
        $request->name = "Ardiman";
        $request->password = "ardiman123";

        $response = $this->userService->register($request);

        self::assertEquals($request->id, $response->user->id);
        self::assertEquals($request->name, $response->user->name);
        self::assertNotEquals($request->password, $response->user->password);

        self::assertTrue(password_verify($request->password, $response->user->password));
    }

    // public function testRegisterFailed()
    // {
    //     # code...
    // }

    // public function testRegisterDuplicate()
    // {
    //     # code...
    // }
}
