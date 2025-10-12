<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = [
    ];


    public function getWebService()
    {
        return $this->hasOne(WebService::class, 'id', 'web_service_id');
    }

    public function getWebServiceModule()
    {

        return $this->hasOne(WebServiceModule::class,'id', 'web_service_module_id');
    }



    public function checkOffer()
    {
        /**
         * @var WebServiceModule $webServiceModule
         */
        $webServiceModule = $this->getWebServiceModule;
        $result =  $webServiceModule->checkOffer($this);
       if($result){
        $this->price = $result->price;
        $this->is_acceptable = $result->is_acceptable;
        $this->is_completed = 1;
        $this->save();
       }
       else{
        $this->price = 0;
        $this->is_acceptable =0;
        $this->is_completed = 1;
        $this->save();
       }
    }

    public function getQuoteRequest()
    {
        return $this->hasOne(QuoteRequest::class, 'id', 'quote_request_id');
    }

    public function accept($body)
    {
        /**
         * @var WebServiceModule $webServiceModule
         */
        $webServiceModule = $this->getWebServiceModule;
        $result =  $webServiceModule->acceptOffer($this,$body);
        return $result;
    }
}
