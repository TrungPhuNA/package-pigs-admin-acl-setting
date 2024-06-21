# Laravel Admin Acl Blog ...

Build core admin, acl, blog setting config


## Description

Build cho vui, tái sửa dụng, ae nào muốn phát triển cứ clone về nhé. 
Version v1.2.4

## Installation

```bash
composer require pigs/admin-acl-setting
```

### Khai báo service  config/app.php
```php
'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        ...
        Pigs\AdminAclSetting\Provides\AdminAclSettingProvider::class,
        ...
    ])->toArray(),
```
### Publish config, asset, migrate, seed data

```bash
php artisan vendor:publish --tag="adm_acl_setting_asset"
```

```bash
php artisan vendor:publish --tag="adm_acl_setting_config"
```

```bash
php artisan vendor:publish --tag="adm_acl_setting_migration"
```

```bash
php artisan adm-acl:seed-permission
```