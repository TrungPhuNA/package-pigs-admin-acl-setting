<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;

class Account extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $guarded = [''];

    const STATUS_ACTIVE = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_CANCEL = -1;

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';

    protected $setStatus = [
        self::STATUS_DEFAULT => [
            'name' => 'Chờ kích hoạt',
            'class' => 'badge bg-secondary'
        ],
        self::STATUS_CANCEL => [
            'name' => 'Khoá/ Block',
            'class' => 'badge bg-danger'
        ],
        self::STATUS_ACTIVE => [
            'name' => 'Hoạt động',
            'class' => 'badge bg-primary'
        ],
    ];

    public function getStatus()
    {
        return Arr::get($this->setStatus,$this->status, []);
    }
}
