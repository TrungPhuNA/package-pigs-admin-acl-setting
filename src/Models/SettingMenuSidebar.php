<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMenuSidebar extends Model
{
    use HasFactory;

    protected $table = 'setting_menus_sidebar';
    protected $guarded = [''];
}
