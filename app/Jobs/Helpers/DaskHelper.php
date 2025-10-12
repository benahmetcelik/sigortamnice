<?php

namespace App\Jobs\Helpers;



use App\Models\Offer;

trait DaskHelper{


    /**
     * @param $response
     * @return Offer
     */
    public function saveOffer($response): Offer
    {
        $formattedResponse = array_merge($this->formatResponse($response),[
            'web_service_id'=>$this->domainModule->web_service_id,
            'web_service_module_id'=>$this->domainModule->web_service_module_id,
            'quote_request_id'=>$this->quoteRequest->id,
            'is_completed'=> (bool)$response
        ]);

        $offer = Offer::create($formattedResponse);
        return $offer;
    }



}
