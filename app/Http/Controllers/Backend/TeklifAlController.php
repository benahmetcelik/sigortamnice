<?php

namespace App\Http\Controllers\Backend;

use App\Events\QuoteRequestCreated;
use App\Http\Controllers\Controller;
use App\Jobs\FetchDaskDataJob;
use App\Models\Dealer;
use App\Models\DealerCustomer;
use App\Models\DomainModule;
use App\Models\Offer;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class TeklifAlController extends Controller
{
    public function   index()
    {
        $domain = request()->finded_domain;
        $items = QuoteRequest::where('domain_id',$domain->id)->paginate(10);
        return view('backend.teklif-al.index',compact('items'));
    }


    public function   create()
    {
        $customer = null;
        if (request('customer_id')) {
            $customer = \App\Models\Customer::findOrFail(request('customer_id'));
        }
        return view('backend.teklif-al.create', compact('customer'));
    }


    public function dask()
    {
        $customer = null;
        if (request('customer_id')) {
            $customer = \App\Models\Customer::findOrFail(request('customer_id'));
        }

        return view('backend.teklif-al.dask',compact('customer'));
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
        if ($customer = DealerCustomer::where('phone',request('phone'))->first()){
            $quoteRequest->dealer_customer_id = $customer->id;
        }else{
            $customer = new DealerCustomer();
            $customer->deal_id = request()->finded_domain?->getDealer?->id ?? Dealer::first()->id;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->city = $request->city;
            $customer->address = $request->address;
            $customer->save();
            $customer->fresh();
            $quoteRequest->dealer_customer_id = $customer->id;
        }
        $quoteRequest->service_type = 'dask';
        $quoteRequest->custom_fields = json_encode([
           'building_type'=>$request->building_type,
            'building_age'=>$request->building_age,
            'building_size'=>$request->building_size,
            'uavt_code'=>$request->uavt_code,
            'building_usage'=>$request->building_usage,
            'building_floor'=>$request->building_floor,
            'total_floors'=>$request->total_floors,
            'building_material'=>$request->building_material,
            'building_risk_class'=>$request->building_risk_class,
            'additional_info'=>$request->additional_info,
        ]);
        $quoteRequest->save();

        FetchDaskDataJob::dispatch($quoteRequest)->onQueue('dask_quote_requests');

        return redirect()->route('admin.teklif-al.index')->with('success', 'DASK teklif talebi başarıyla oluşturuldu.');
    }


    public function sonuclarCanliIzle($teklifId)
    {
        $quoteRequest = QuoteRequest::with('getOffers')
        ->findOrFail($teklifId);
        if ($quoteRequest->whereHas('getOffers',function ($query){
                $query->where('is_completed', false);
            })->count() == 0) {
            $quoteRequest->is_completed = true;
        }else{
            $quoteRequest->is_completed = false;

        }
        $quoteRequest->save();

        return view('backend.teklif-al.sonuclar-izle',compact('teklifId','quoteRequest'));
    }


    public function liveResults(Request $request)
    {
        return response()->json(Offer::findOrFail($request->id));
    }
}
