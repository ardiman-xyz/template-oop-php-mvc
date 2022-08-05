<?php

namespace Ardiman\BelajarPhpMvc\Repository;

use Ardiman\BelajarPhpMvc\Config\Database;
use Ardiman\BelajarPhpMvc\Domain\User;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();
    }

    public function testSaveSucces()
    {
        $user = new User();
        $user->id = "ardiman";
        $user->name = "Ardiman";
        $user->password = "ardiman123";

        $this->userRepository->save($user);

        $resuslt = $this->userRepository->findById($user->id);

        assertEquals($user->id, $resuslt->id);
        assertEquals($user->name, $resuslt->name);
        assertEquals($user->password, $resuslt->password);
    }

    public function findByIdNotFound()
    {
        $user = $this->userRepository->findById("sdfs");

        assertNull($user);
    }
}
