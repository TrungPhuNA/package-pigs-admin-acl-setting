<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmAclArticleTag extends Model
{
    use HasFactory;
    protected $table = 'articles_tags';
    protected $guarded = [''];
}
