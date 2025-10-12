<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\FetchDaskDataJob;
use App\Models\Dealer;
use App\Models\DealerCustomer;
use App\Models\Offer;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use SoapClient;
use SoapFault;
use phpseclib\Crypt\RSA;
use phpseclib\Crypt\Hash;

class TeklifAlController extends Controller
{



    public function policelestir(Offer $id)
    {


        $offer = $id;
        /**
         * @var QuoteRequest $offer
         */
        $quota_req = $offer->getQuoteRequest;
        $customer = $quota_req->getDealerCustomer;
        $form_inputs = (object)json_decode($quota_req->custom_fields);


        $result = $offer->accept(
            [
                'Policy' => [
                    'PolicyNumber' => 117000004314441,
                    'EndorsNr' => 0,
                    'RenewalNr' => 0, // 0 olmalı demiş döküman,
                    'FirmCode' => 0, // 0 olmalı demiş döküman,
                    'CompanyCode' => 0, // 0 olmalı demiş döküman,
                ],
                'PaymentInput' => [
                    'Installment' => 1,
                    'CreditCardCvv' => $this->encryptedBinary('000'),
                    'CreditCardEndYear' => $this->encryptedBinary('2025'),
                    'CreditCardEndMonth' => $this->encryptedBinary('12'),
                    'CreditCardNameSurname' => $this->encryptedBinary('Ahmet ÇELİK'),
                    'CreditCardNumber' => $this->encryptedBinary('000000000000'),
                    'PaymentType'=>0
                ],
                'Unit' => [
                    'ADDRESS_LIST' => [
                        'ADDRESS_TYPE' => $form_inputs->uavt_code,
                        'ADDRESS_DATA' => $customer->address
                    ],
                    'IDENTITY_NO' => $customer->passport_no,
                    'TAX_NO' => null,
                    'PHONE_COUNTRY_CODE' => null,
                    'PHONE_CODE' => null,
                    'PHONE_NUMBER' =>null,
                    'GSM_COUNTRY_CODE' => '+90',
                    'GSM_CODE' => '546',
                    'GSM_NUMBER' => '5414635',
                    'EMAIL_ADDRESS' => $customer->email,
                ]

            ]
        );

        dd($result);


        die();

        return view('themes.ThemeOne.pages.teklif-al.policelestir', compact('offer'));

    }

    public function daskStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'address' => 'required|string',
            'building_type' => 'required|string',
            'building_age' => 'required|integer|min:0',
            'building_size' => 'required|numeric|min:0',
            'uavt_code' => 'required|string|max:255',
            'building_usage' => 'required|string|max:255',
            'building_floor' => 'required|integer|min:0',
            'total_floors' => 'required|integer|min:0',
            'building_material' => 'required|string|max:255',
            'building_risk_class' => 'required|string|max:255',
            'additional_info' => 'nullable|string|max:255',
        ]);

        $quoteRequest = new QuoteRequest();
        $quoteRequest->domain_id = request()->finded_domain->id;
        if ($customer = DealerCustomer::where('passport_no', request('passport_no'))->first()) {
            $quoteRequest->dealer_customer_id = $customer->id;
        } else {
            $customer = new DealerCustomer();
            $customer->deal_id = request()->finded_domain?->getDealer?->id ?? Dealer::first()->id;
            $customer->name = $request->name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->city = $request->city;
            $customer->passport_no = $request->passport_no;
            $customer->address = $request->address;
            $customer->save();
            $customer->fresh();
            $quoteRequest->dealer_customer_id = $customer->id;
        }
        $quoteRequest->service_type = 'dask';
        $quoteRequest->custom_fields = json_encode([
            'building_type' => $request->building_type,
            'building_age' => $request->building_age,
            'building_size' => $request->building_size,
            'uavt_code' => $request->uavt_code,
            'building_usage' => $request->building_usage,
            'building_floor' => $request->building_floor,
            'total_floors' => $request->total_floors,
            'building_material' => $request->building_material,
            'building_risk_class' => $request->building_risk_class,
            'additional_info' => $request->additional_info,
        ]);
        $quoteRequest->is_completed = false;
        $quoteRequest->save();

        FetchDaskDataJob::dispatch($quoteRequest)->onQueue('dask_quote_requests');

        return redirect()->route('dask.teklifler.incele', $quoteRequest->id)->with('success', 'DASK teklif talebi başarıyla oluşturuldu.');
    }


    public function sonuclarCanliIzle($teklifId)
    {
        $quoteRequest = QuoteRequest::with('getOffers')
            ->findOrFail($teklifId);

        if ($quoteRequest->whereHas('getOffers', function ($query) {
                $query->where('is_completed', false);
            })->count() == 0) {
            $quoteRequest->is_completed = true;
        } else {
            $quoteRequest->is_completed = false;

        }
        $quoteRequest->save();

        return view('pages.teklif-al.sonuclar-izle', compact('teklifId', 'quoteRequest'));
    }


    public function liveResults(Request $request)
    {
        return response()->json(Offer::findOrFail($request->id));
    }
}
