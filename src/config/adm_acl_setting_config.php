<?php
/**
 * Created By PhpStorm
 * User: trungphuna
 * Date: 6/12/24
 * Time: 2:12 PM
 */

return [
    'prefix' => 'admin/',
    'sidebar' => [
        [
            'name' => 'Tổng quan',
            'icon' => 'fas fa-tachometer-alt',
            'route' => 'get.adm_acl_setting.dashboard',
            'icon-v2' => 'uil-home-alt',
            'prefix'  => ['']
        ],
        [
            'name' => 'Permission',
            'icon' => 'fas fa-tags',
            'icon-v2' => 'uil-store',
            'route' => 'get.adm_acl_setting.permission.index',
            'prefix'  => ['permission']
        ],
        [
            'name' => 'Role',
            'icon' => 'fas fa-pencil',
            'route' => 'get.adm_acl_setting.role.index',
            'icon-v2' => 'uil-key-skeleton',
            'prefix'  => ['role']
        ],
        [
            'name' => 'Account',
            'icon' => 'fas fa-sticky-note',
            'icon-v2' => 'uil-user-check',
            'route' => 'get.adm_acl_setting.user.index',
            'prefix'  => ['account']
        ],
    ]
];