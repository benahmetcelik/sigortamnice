<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'domains';

    protected $fillable = [
        'domain',
        'status',
        'expires_at',
        'theme_id'

    ];

    protected $casts = [
        'status' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function isActive(): bool
    {
        return $this->status && !$this->isExpired();
    }


    public function theme()
    {
        return $this->hasOne(Theme::class, 'id', 'theme_id');
    }

    public static function current()
    {
        $host = request()->getHost();
        return  self::where('domain',$host)->first();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_domain');
    }

    public function modules(): HasMany
    {
        return $this->hasMany(DomainModule::class);
    }


    public function webServices()
    {
        return $this->belongsToMany(WebService::class, 'domain_modules')
            ->withPivot('web_service_module_id')
            ->withTimestamps();
    }




    // Domain'e ait ui_modules (UI modülleri) ilişkisi
    public function uiModules()
    {
        return $this->hasMany(UIModule::class);
    }


    public function getDealer()
    {

        return $this->belongsTo(Dealer::class, 'id','domain_id');
    }
}
