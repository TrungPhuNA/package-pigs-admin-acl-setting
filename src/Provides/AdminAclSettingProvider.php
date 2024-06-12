<?php
/**
 * Created By PhpStorm
 * User: trungphuna
 * Date: 6/12/24
 * Time: 2:10 PM
 */

namespace Pigs\AdminAclSetting\Provides;

use Illuminate\Support\ServiceProvider;

class AdminAclSettingProvider extends ServiceProvider
{
    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'adm_acl_setting');
        $this->mergeConfigFrom(
            __DIR__.'/../config/adm_acl_setting_config.php','adm_acl_setting_config'
        );

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/adm_acl_setting'),
        ]);

        $this->publishes([
            __DIR__.'/../config/adm_blog_config.php' => config_path('adm_acl_setting_config.php')
        ], 'adm_acl_setting_config');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ],'adm_acl_setting_migration');
    }
}