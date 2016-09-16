<?php

namespace App\Providers;

use App\Domain\User;
use App\Exceptions\InvalidTokenException;
use App\Services\AuthService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

/**
 * Class AuthServiceProvider
 *
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    const COOKIE_NAME = 'MERGERMARKET';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request) {

            $token = $request->cookie(self::COOKIE_NAME);
            /** @var  AuthService $authService */
            $authService = App::make('App\Services\AuthServiceInterface');

            try {
                $user = $authService->getUser($token);
                return $user;
            } catch (InvalidTokenException $e) {
                return null;
            }
        });
    }
}
