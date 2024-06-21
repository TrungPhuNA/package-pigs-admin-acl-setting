<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmAclTag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $guarded = [''];
}
