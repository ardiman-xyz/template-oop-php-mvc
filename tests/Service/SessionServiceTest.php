<?php

namespace Ardiman\BelajarPhpMvc\Service;

use Ardiman\BelajarPhpMvc\Config\Database;
use Ardiman\BelajarPhpMvc\Repository\SessionRepository;
use PHPUnit\Framework\TestCase;

class SessionServiceTest extends TestCase
{
    private SessionService $sessionService;
    private SessionRepository $sessionRepostory;

    protected function setUp(): void
    {
        $connection = Database::getConnection();
        $this->sessionRepostory = new SessionRepository($connection);
        $this->sessionService = new SessionService($this->sessionRepostory);
    }

    public function testCreate()
    {
        $session = $this->sessionService->create("ardiman");
        // $this->expectOutputRegex("[PHP-MVC: $session->id]");

        $result = $this->sessionRepostory->findById($session->id);

        self::assertEquals("ardiman", $result->userId);
    }
}
