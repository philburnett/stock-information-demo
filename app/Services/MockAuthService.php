<?php

namespace App\Services;

use App\Domain\User;
use App\Exceptions\InvalidTokenException;

/**
 * Class MockAuthService
 *
 * Auth decoupled from the service.  Set ?noauth=true in the request to
 * simualte no authentication, otherwise auth will pass.
 *
 * @package App\Services
 */
class MockAuthService implements AuthServiceInterface
{
    /**
     * @param $token
     *
     * @return User
     * @throws InvalidTokenException
     */
    public function getUser($token)
    {
        if (isset($_GET['noauth'])) {
            throw new InvalidTokenException('No token set');
        }

        return new User();
    }
}
