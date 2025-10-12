<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\OfferService;

class WebServiceModule extends Model
{
    use HasFactory;

    protected $table = 'web_service_modules';


    protected $fillable = [
        'name',
        'requirements',
        'web_service_id',
        'settings',
    ];

    protected $casts = [
        'requirements' => 'array',
        'settings' => 'array',
    ];
    public function webService(): BelongsTo
    {
        return $this->belongsTo(WebService::class);
    }

    // Domain modülleriyle ilişki
    public function domainModules()
    {
        return $this->hasMany(DomainModule::class);
    }

    public function checkOffer(Offer $offer)
    {

        $service = new OfferService($this);
        $result = $service->checkOffer($offer);
        return $result;
    }

    public function acceptOffer(Offer $offer,$body)
    {
        $service = new OfferService($this);
        $result = $service->acceptOffer($offer,$body);
        return $result;
    }


}
