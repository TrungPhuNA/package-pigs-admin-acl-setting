<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmAclPage extends Model
{
    use HasFactory;
    protected $table = "adm_acl_pages";
    protected $guarded = [""];
}
