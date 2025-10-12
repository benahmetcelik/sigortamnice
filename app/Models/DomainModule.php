<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainModule extends Model
{
    use HasFactory;

    protected $table = 'domain_modules';

    protected $fillable = [
        'domain_id',
        'web_service_id',
        'web_service_module_id'
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function webService()
    {
        return $this->belongsTo(WebService::class);
    }

    public function webServiceModule()
    {
        return $this->belongsTo(WebServiceModule::class);
    }
}
