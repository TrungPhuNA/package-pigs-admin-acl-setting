<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmAclMenu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $guarded = [''];
}
