<?php

namespace Ardiman\BelajarPhpMvc\Service;

use Ardiman\BelajarPhpMvc\Config\Database;
use Ardiman\BelajarPhpMvc\Domain\Session;
use Ardiman\BelajarPhpMvc\Repository\SessionRepository;

class SessionService
{
    public static string $COOKIE_NAME = "PHP-MVC";
    private SessionRepository $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $connection = Database::getConnection();
        $this->sessionRepository = new SessionRepository($connection);
    }

    public function create(string $userId): Session
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = $userId;

        $this->sessionRepository->save($session);

        setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 30), '/');

        return $session;
    }
}
