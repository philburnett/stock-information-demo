<?php

namespace App\Services;

use App\Domain\User;
use App\Exceptions\InvalidTokenException;

/**
 * Interface AuthServiceInterface
 *
 * @package App\Services
 */
interface AuthServiceInterface
{
    /**
     * @param $token
     *
     * @return User
     * @throws InvalidTokenException
     */
    public function getUser($token);
}
