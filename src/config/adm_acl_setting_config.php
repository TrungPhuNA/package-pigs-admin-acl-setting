<?php
/**
 * Created By PhpStorm
 * User: trungphuna
 * Date: 6/12/24
 * Time: 2:12 PM
 */

return [
    'prefix'  => 'admin/',
    'sidebar' => [
        [
            'name'    => 'Tổng quan',
            'icon'    => 'fas fa-tachometer-alt',
            'route'   => 'get.adm_acl_setting.dashboard',
            'icon-v2' => 'uil-home-alt',
            'prefix'  => ['']
        ],
        [
            'name'    => 'Permission',
            'icon'    => 'fas fa-tags',
            'icon-v2' => 'uil-store',
            'route'   => 'get.adm_acl_setting.permission.index',
            'prefix'  => ['permission']
        ],
        [
            'name'    => 'Role',
            'icon'    => 'fas fa-pencil',
            'route'   => 'get.adm_acl_setting.role.index',
            'icon-v2' => 'uil-key-skeleton',
            'prefix'  => ['role']
        ],
        [
            'name'     => 'Blog',
            'icon-v2'  => 'uil-notebooks',
            'route'    => '',
            'key'      => 'blog',
            'submenus' => [
                [
                    'name'    => 'Tags',
                    'icon'    => 'fas fa-sticky-note',
                    'icon-v2' => 'uil-pricetag-alt',
                    'route'   => 'get.adm_acl_setting.tag.index',
                    'prefix'  => ['tag']
                ],
                [
                    'name'    => 'Menu',
                    'icon'    => 'fas fa-sticky-note',
                    'icon-v2' => 'uil-list-ul',
                    'route'   => 'get.adm_acl_setting.menu.index',
                    'prefix'  => ['menu']
                ],
                [
                    'name'    => 'Article',
                    'icon'    => 'fas fa-sticky-note',
                    'icon-v2' => 'uil-user-check',
                    'route'   => 'get.adm_acl_setting.article.index',
                    'prefix'  => ['article']
                ],
            ],
            'prefix'   => ['tag', 'menu', 'article']
        ],
        [
            'name'    => 'Setting Website',
            'icon'    => 'fas fa-cogs',
            'icon-v2' => 'uil-cog',
            'route'   => 'get.adm_acl_setting.setting.index',
            'prefix'  => ['setting','user']
        ],
    ],
    'blog'    => [
        'table' => [
            'menu'          => env('ADM_BLOG_TABLE_MENU', 'menus'),
            'articles'      => env('ADM_BLOG_TABLE_ARTICLES', 'articles'),
            'tags'          => env('ADM_BLOG_TABLE_TAGS', 'tags'),
            'articles_tags' => env('ADM_BLOG_TABLE_ARTICLES_TAGS', 'articles_tags'),
        ],
    ]
];