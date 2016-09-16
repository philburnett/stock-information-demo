<?php

namespace App\Services;

use App\Domain\User;
use App\Exceptions\InvalidTokenException;
use App\Http\Clients\Auth;

/**
 * Class AuthService
 *
 * @package App\Services
 */
class AuthService implements AuthServiceInterface
{
    /**
     * @var Auth
     */
    private $authClient;

    public function __construct(Auth $authClient)
    {
        $this->authClient = $authClient;
    }

    /**
     * @param $token
     *
     * @return User
     * @throws InvalidTokenException
     */
    public function getUser($token)
    {
        $response = $this->authClient->get($token);

        if ($response !== false) {
            $user = User::fromApiResponse($this->authClient->getResponse());
            return $user;
        }

        throw new InvalidTokenException('Invalid Authentication Token');

    }
}
