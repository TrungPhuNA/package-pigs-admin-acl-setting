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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Pigs\AdminAclSetting\Models\SettingWebsite;

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
        $this->registerConfigEmail();
        $this->publishesConfig();
    }

    public function publishesConfig(): void
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

    public function registerConfigEmail(): void
    {
        if (Schema::hasTable('settings_website')) {
            $emailSettings = SettingWebsite::first();
            if ($emailSettings) {
//                dump($emailSettings->mail_driver);
//                dump($emailSettings->mail_host);
//                dump($emailSettings->mail_port);
//                dump($emailSettings->mail_username);
//                dump($emailSettings->mail_password);
//                dump($emailSettings->mail_encryption);
//                dump($emailSettings->mail_from_address);
//                dump($emailSettings->mail_domain);
                Config::set('mail.mailer', $emailSettings->mail_driver);
                Config::set('mail.host', $emailSettings->mail_host);
                Config::set('mail.port', $emailSettings->mail_port);
                Config::set('mail.username', $emailSettings->mail_username);
                Config::set('mail.password', $emailSettings->mail_password);
                Config::set('mail.encryption', $emailSettings->mail_encryption ?? "tls");
                Config::set('mail.from.address', $emailSettings->mail_from_address);
                Config::set('mail.from.name', $emailSettings->mail_domain);
            }
        }
    }
}