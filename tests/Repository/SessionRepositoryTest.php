<?php

namespace Ardiman\BelajarPhpMvc\Repository;

use Ardiman\BelajarPhpMvc\Config\Database;
use Ardiman\BelajarPhpMvc\Domain\Session;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNull;

class SessionRepositoryTest extends TestCase
{
    private SessionRepository $sessionRepository;

    protected function setUp(): void
    {
        $connection = Database::getConnection();
        $this->sessionRepository = new SessionRepository($connection);

        $this->sessionRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "ardiman";

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);

        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);
    }

    public function testDeleteByIdSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "boby";

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);

        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);

        $this->sessionRepository->deleteById($session->id);

        $row = $this->sessionRepository->findById($session->id);

        self::assertNull($row);
    }

    public function testFindByIdNotFound()
    {
        $result = $this->sessionRepository->findById("nulll");

        assertNull($result);
    }
}
