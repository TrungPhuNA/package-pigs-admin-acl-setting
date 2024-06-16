<?php
/**
 * Created By PhpStorm
 * User: trungphuna
 * Date: 6/4/24
 * Time: 3:42  PM
 */

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Pigs\AdminAclSetting\Http\Controllers', 'prefix' => 'auth-acl', 'middleware' => 'web'],
    function () {
        Route::get('login', 'AdminAclLoginController@login')->name('get.adm_acl_setting.login');
        Route::post('login', 'AdminAclLoginController@postLogin');

        Route::get('logout', 'AdminAclLoginController@logout')->name('get.adm_acl_setting.logout');

        Route::get('register', 'AdminAclRegisterController@register')->name('get.adm_acl_setting.register');
        Route::post('register', 'AdminAclRegisterController@postRegister');
    });

Route::group(['namespace'  => 'Pigs\AdminAclSetting\Http\Controllers', 'prefix' => 'admin-acl',
              'middleware' => ['web', 'check_login_admin']
], function () {
    Route::get('', 'AdminAclDashboardController@index')->name('get.adm_acl_setting.dashboard');
    Route::group(['namespace' => 'Acl'], function () {
        Route::group(['prefix' => 'permission'], function () {
            Route::get('', 'AdminAclPermissionController@index')->name('get.adm_acl_setting.permission.index');

            Route::get('create', 'AdminAclPermissionController@create')->name('get.adm_acl_setting.permission.create');
            Route::post('create', 'AdminAclPermissionController@store')->name('get.adm_acl_setting.permission.store');

            Route::get('update/{id}',
                'AdminAclPermissionController@edit')->name('get.adm_acl_setting.permission.update')->name('get.adm_acl_setting.permission.update');
            Route::post('update/{id}', 'AdminAclPermissionController@update')->name('get.adm_acl_setting.permission.update');

            Route::get('delete/{id}',
                'AdminAclPermissionController@delete')->name('get.adm_acl_setting.permission.delete');
        });
        Route::group(['prefix' => 'role'], function () {
            Route::get('', 'AdminAclRoleController@index')->name('get.adm_acl_setting.role.index');

            Route::get('create', 'AdminAclRoleController@create')->name('get.adm_acl_setting.role.create');
            Route::post('create', 'AdminAclRoleController@store')->name('get.adm_acl_setting.role.store');

            Route::get('update/{id}', 'AdminAclRoleController@edit')->name('get.adm_acl_setting.role.update');
            Route::post('update/{id}', 'AdminAclRoleController@update');

            Route::get('delete/{id}', 'AdminAclRoleController@delete')->name('get.adm_acl_setting.role.delete');
        });
        Route::group(['prefix' => 'user'], function () {
            Route::get('', 'AdminAclUserController@index')->name('get.adm_acl_setting.user.index');

            Route::get('create', 'AdminAclUserController@create')->name('get.adm_acl_setting.user.create');
            Route::post('create', 'AdminAclUserController@store')->name('get.adm_acl_setting.user.store');

            Route::get('update/{id}', 'AdminAclUserController@edit')->name('get.adm_acl_setting.user.update');
            Route::post('update/{id}', 'AdminAclUserController@update');

            Route::get('delete/{id}', 'AdminAclUserController@delete')->name('get.adm_acl_setting.user.delete');
        });
    });

    Route::group(['prefix' => 'setting', 'namespace' => 'Setting'], function () {
        Route::get('', 'AdminAclSettingController@index')->name('get.adm_acl_setting.setting.index');
        Route::get('general', 'AdminAclSettingController@general')->name('get.adm_acl_setting.setting.general');
        Route::post('general', 'AdminAclSettingController@insertOrUpdateSetting');
    });

    Route::group(['prefix' => 'blog', 'namespace' => 'Blog'], function () {
        Route::group(['prefix' => 'tag'], function () {
            Route::get('', 'AdminAclSettingTagController@index')->name('get.adm_acl_setting.tag.index');

            Route::get('create', 'AdminAclSettingTagController@create');
            Route::post('create', 'AdminAclSettingTagController@store')->name('get.adm_acl_setting.tag.create');

            Route::get('update/{id}', 'AdminAclSettingTagController@edit')->name('get.adm_acl_setting.tag.update');
            Route::post('update/{id}', 'AdminAclSettingTagController@update');

            Route::get('delete/{id}', 'AdminAclSettingTagController@delete')->name('get.adm_acl_setting.tag.delete');
        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('', 'AdminAclSettingMenuController@index')->name('get.adm_acl_setting.menu.index');

            Route::get('create', 'AdminAclSettingMenuController@create');
            Route::post('create', 'AdminAclSettingMenuController@store')->name('get.adm_acl_setting.menu.create');

            Route::get('update/{id}', 'AdminAclSettingMenuController@edit')->name('get.adm_acl_setting.menu.update');
            Route::post('update/{id}', 'AdminAclSettingMenuController@update')->name('get.adm_acl_setting.menu.update');

            Route::get('delete/{id}', 'AdminAclSettingMenuController@delete')->name('get.adm_acl_setting.menu.delete');
        });

        Route::group(['prefix' => 'article'], function () {
            Route::get('', 'AdminAclSettingArticleController@index')->name('get.adm_acl_setting.article.index');

            Route::get('create', 'AdminAclSettingArticleController@create')->name('get.adm_acl_setting.article.create');
            Route::post('create', 'AdminAclSettingArticleController@store');

            Route::get('update/{id}',
                'AdminAclSettingArticleController@edit')->name('get.adm_acl_setting.article.update');
            Route::post('update/{id}', 'AdminAclSettingArticleController@update');

            Route::get('delete/{id}',
                'AdminAclSettingArticleController@delete')->name('get.adm_acl_setting.article.delete');
        });
    });

})->middleware('auth');