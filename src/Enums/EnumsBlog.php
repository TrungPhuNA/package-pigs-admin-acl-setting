<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 6/15/24
 */

namespace Pigs\AdminAclSetting\Enums;

class EnumsBlog
{
    const STATUS_PENDING = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_DRAFT = -1;

    const GET_TEXT_STATUS = [
        self::STATUS_PENDING   => [
            'name'  => 'Pending',
            'class' => 'badge bg-secondary'
        ],
        self::STATUS_PUBLISHED => [
            'name'  => 'Published',
            'class' => 'badge bg-primary'
        ],
        self::STATUS_DRAFT     => [
            'name'  => 'Draft',
            'class' => 'badge bg-danger'
        ]
    ];
}
