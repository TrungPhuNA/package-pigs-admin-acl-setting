<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingWebsite extends Model
{
    use HasFactory;
    protected $table = 'settings_website';
    protected $guarded = [''];
}
