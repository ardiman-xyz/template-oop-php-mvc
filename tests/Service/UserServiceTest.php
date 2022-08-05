<?php

namespace Ardiman\BelajarPhpMvc\Service;

use Ardiman\BelajarPhpMvc\Config\Database;
use Ardiman\BelajarPhpMvc\Domain\User;
use Ardiman\BelajarPhpMvc\Exception\ValidationException;
use Ardiman\BelajarPhpMvc\Model\UserRegisterRequest;
use Ardiman\BelajarPhpMvc\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $connection = Database::getConnection();
        $this->userRepository = new UserRepository($connection);
        $this->userService = new UserService($this->userRepository);

        $this->userRepository->deleteAll();
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

    public function testRegisterFailed()
    {
        $this->expectException(ValidationException::class);

        $request = new UserRegisterRequest();
        $request->id = "";
        $request->name = "";
        $request->password = "";

        $response = $this->userService->register($request);
    }

    public function testRegisterDuplicate()
    {
        $user = new User();
        $user->id = "ardiman";
        $user->name = "Ardiman";
        $user->password = "ardiman123";

        $this->userRepository->save($user);

        $this->expectException(ValidationException::class);

        $request = new UserRegisterRequest();
        $request->id = "ardiman";
        $request->name = "Ardiman";
        $request->password = "ardiman123";

        $this->userService->register($request);
    }
}
