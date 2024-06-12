<?php
/**
 * Created By PhpStorm
 * User: trungphuna
 * Date: 6/4/24
 * Time: 3:42  PM
 */

use Illuminate\Support\Facades\Route;
Route::get('/admin-acl', function (){
   return "OK";
});
Route::group(['namespace' => 'Pigs\AdminAclSetting\Http\Controllers','prefix' => 'admin-acl'], function() {
    Route::get('', 'AdminAclDashboardController@index')->name('get.adm_acl_setting.dashboard');

    Route::group(['prefix' => 'permission'], function (){
        Route::get('','AdminAclPermissionController@index')->name('get.adm_acl_setting.permission.index');

        Route::get('create','AdminAclPermissionController@create')->name('get.adm_acl_setting.permission.create');
        Route::post('create','AdminAclPermissionController@store')->name('get.adm_acl_setting.permission.store');

        Route::get('update/{id}','AdminAclPermissionController@edit')->name('get.adm_acl_setting.permission.update');
        Route::post('update/{id}','AdminAclPermissionController@update');

        Route::get('delete/{id}','AdminAclPermissionController@delete')->name('get.adm_acl_setting.permission.delete');
    });

    Route::group(['prefix' => 'role'], function (){
        Route::get('','AdminAclRoleController@index')->name('get.adm_acl_setting.role.index');

        Route::get('create','AdminAclRoleController@create')->name('get.adm_acl_setting.role.create');
        Route::post('create','AdminAclRoleController@store')->name('get.adm_acl_setting.role.store');

        Route::get('update/{id}','AdminAclRoleController@edit')->name('get.adm_acl_setting.role.update');
        Route::post('update/{id}','AdminAclRoleController@update');

        Route::get('delete/{id}','AdminAclRoleController@delete')->name('get.adm_acl_setting.role.delete');
    });

    Route::group(['prefix' => 'user'], function (){
        Route::get('','AdminAclUserController@index')->name('get.adm_acl_setting.user.index');

        Route::get('create','AdminAclUserController@create')->name('get.adm_acl_setting.user.create');
        Route::post('create','AdminAclUserController@store')->name('get.adm_acl_setting.user.store');

        Route::get('update/{id}','AdminAclUserController@edit')->name('get.adm_acl_setting.user.update');
        Route::post('update/{id}','AdminAclUserController@update');

        Route::get('delete/{id}','AdminAclUserController@delete')->name('get.adm_acl_setting.user.delete');
    });
});