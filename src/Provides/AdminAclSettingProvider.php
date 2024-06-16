<?php
/**
 * Created By PhpStorm
 * User: trungphuna
 * Date: 6/12/24
 * Time: 2:10 PM
 */

namespace Pigs\AdminAclSetting\Provides;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Pigs\AdminAclSetting\Command\AclSeedPermissionCommand;
use Pigs\AdminAclSetting\Middleware\CheckLoginAdminMiddleware;

class AdminAclSettingProvider extends ServiceProvider
{
    public function boot() {
        $router = $this->app->make(Router::class);
        $router->middlewareGroup('web', [
                \App\Http\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \App\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ]
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                AclSeedPermissionCommand::class,
            ]);
        }

        $router->aliasMiddleware('check_login_admin',CheckLoginAdminMiddleware::class);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'adm_acl_setting');
        $this->publishesConfig();
    }

    public function publishesConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/adm_acl_setting_config.php','adm_acl_setting_config'
        );

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/adm_acl_setting'),
        ]);
        $this->publishes([
            __DIR__.'/../theme_admin' => resource_path('../public/theme_admin'),
        ], 'adm_acl_setting_asset');

        $this->publishes([
            __DIR__.'/../config/adm_blog_config.php' => config_path('adm_acl_setting_config.php')
        ], 'adm_acl_setting_config');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ],'adm_acl_setting_migration');
    }
}