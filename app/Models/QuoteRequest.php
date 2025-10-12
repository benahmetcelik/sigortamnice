<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    public function getDealerCustomer()
    {
        return $this->hasOne(DealerCustomer::class, 'id','dealer_customer_id');
    }

    public function getDealer()
    {
        return $this->hasOne(Dealer::class, 'id','dealer_id');
    }


    public function getDomain()
    {
        return $this->hasOne(Domain::class, 'id','domain_id');
    }

    public function getOffers()
    {
        return $this->hasMany(Offer::class, 'quote_request_id','id');
    }

    public function getWebServiceModule()
    {
        $this->hasOne(WebServiceModule::class, 'id','web_service_module_id');
    }

    public function getWebService()
    {
        $this->hasOne(WebService::class, 'id','web_service_id');
    }
}
