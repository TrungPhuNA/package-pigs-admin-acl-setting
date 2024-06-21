<?php

namespace Pigs\AdminAclSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmAclArticle extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $guarded = [''];

    public function menu()
    {
        return $this->belongsTo(AdmAclMenu::class,'menu_id');
    }
}
