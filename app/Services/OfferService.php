<?php

namespace App\Services;

use App\Models\DomainModule;
use App\Models\Offer;
use ReflectionClass;

class OfferService
{
    public $webServiceModule;

    public function __construct($webServiceModule)
    {
        $this->webServiceModule = $webServiceModule;
    }


    public function checkOffer(Offer $offer)
    {
        $findService = $this->findService($offer);
        $serviceType = $offer->getWebServiceModule->type;
        return $findService->checkOffer($serviceType, $offer);
    }


    public function acceptOffer(Offer $offer,$body)
    {
        $findService = $this->findService($offer);
        $serviceType = $offer->getWebServiceModule->type;
        return $findService->acceptOffer($serviceType, $offer,$body);
    }

    public function findService(Offer $offer)
    {
        $webService = $this->webServiceModule->webService;

        $setting = collect(DomainModule::where('web_service_module_id',$offer->web_service_module_id)->first()?->settings)
            ->flatMap(function ($item) {
                return [$item['key'] => $item['value']];
            })->toArray();


        return match ($webService->name) {
            'Koru Sigorta' => NipponService::class,
            'Hepiyi Sigorta' => NipponService::class,
            'Doğa Sigorta' => NipponService::class,
            'Sompo Sigorta' => new SompoDaskService(
                username: $setting['username'],
                password: $setting['password'],
                ip: $setting['proxy_port'],
                proxy_host: $setting['proxy_host'],
                proxy_port: $setting['proxy_port'],
                proxy_user: $setting['proxy_user'],
                proxy_pass: $setting['proxy_pass']
            ),
            'Türk Nippon Sigorta' => NipponService::class,
            default => NipponService::class
        };
    }
}
