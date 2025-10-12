<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeModule extends Model
{
    use HasFactory;

    // ThemeModule'a ait UI modülü ilişkisi
    public function uiModules()
    {
        return $this->hasMany(UIModule::class,'module_id','id');
    }

    public function uiModule()
    {
        return $this->hasOne(UIModule::class,'module_id','id');
    }
}
