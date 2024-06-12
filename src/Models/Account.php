<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Account extends Model
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
            'class' => 'badge badge-light'
        ],
        self::STATUS_CANCEL => [
            'name' => 'Khoá/ Block',
            'class' => 'badge badge-danger'
        ],
        self::STATUS_ACTIVE => [
            'name' => 'Hoạt động',
            'class' => 'badge badge-primary'
        ],
    ];

    public function getStatus()
    {
        return Arr::get($this->setStatus,$this->status, []);
    }
}