<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebService extends Model
{
    use HasFactory;

    protected $table = 'web_services';

    protected $fillable = [
        'name',
    ];

    public function modules()
    {
        return $this->hasMany(WebServiceModule::class);
    }

    public function domains()
    {
        return $this->belongsToMany(Domain::class, 'domain_modules')
            ->withPivot('web_service_module_id')
            ->withTimestamps();
    }




}
