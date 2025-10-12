<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'path', 'image', 'demo_url'
    ];

    public function themeModules()
    {
        return $this->hasMany(ThemeModule::class,'theme_id','id');
    }

    // Domain ile ilişki
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

}
