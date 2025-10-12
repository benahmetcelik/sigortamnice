<?php

namespace App\Listeners;

use App\Events\QuoteRequestCreated;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;
class CreateOfferServiceRecords
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(QuoteRequestCreated $event): void
    {

        $quote = $event->quote;
        $service_type = $quote->service_type;
        $modules = DB::select("
        select * from domain_modules
inner join web_services on domain_modules.web_service_id = web_services.id
inner join web_service_modules on domain_modules.web_service_module_id = web_service_modules.id

where domain_id = {$quote->getDomain->id}
and web_service_modules.type = '{$service_type}'");



        foreach ($modules as $service) {
            $service = (object)$service;
            $offer = new Offer();
            $offer->web_service_id = $service->web_service_id;
            $offer->web_service_module_id = $service->web_service_module_id;
            $offer->quote_request_id = $quote->id;
            $offer->is_completed = false;
            $offer->is_acceptable = false;
            $offer->save();
        }
    }
}
