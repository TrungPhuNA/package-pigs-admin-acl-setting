<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPermission extends Model
{
    use HasFactory;
    protected $table = 'accounts_permission';
    protected $guarded = [''];
}
