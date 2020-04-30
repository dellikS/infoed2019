<?php

namespace App\Http;

use App\Http\Middleware\CheckIsUserActivated;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\LanguageSwitcher::class,
            \App\Http\Middleware\EncryptCookies::class,
            \App\Http\Middleware\ForceHttpsProtocol::class
        ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
        'activated' => [
            CheckIsUserActivated::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'          => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'    => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'      => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'           => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'         => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'      => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'activated'     => CheckIsUserActivated::class,
        'role'          => \jeremykenedy\LaravelRoles\Middleware\VerifyRole::class,
        'permission'    => \jeremykenedy\LaravelRoles\Middleware\VerifyPermission::class,
        'level'         => \jeremykenedy\LaravelRoles\Middleware\VerifyLevel::class,
        'currentUser'   => \App\Http\Middleware\CheckCurrentUser::class,
        'ownsBiz'       => \App\Http\Middleware\CheckOwnsBusiness::class,
        'ownerBiz'      => \App\Http\Middleware\CheckOwnerBusiness::class,
        'apply'         => \App\Http\Middleware\CheckRecruitment::class,
        'lang'          => \App\Http\Middleware\LanguageSwitcher::class,
    ];
}