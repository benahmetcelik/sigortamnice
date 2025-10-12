<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaskController extends Controller
{
    public function index()
    {
        $customer = null;
        if (request()->has('customer_id')) {
            $customer = \App\Models\Customer::find(request()->customer_id);
        }
        return view('backend.teklif-al.dask', compact('customer'));
    }

    public function teklif(Request $request)
    {
        $validated = $request->validate([
            'tc_no' => 'required|digits:11',
            'uavt_code' => 'required',
            'gross_area' => 'required|numeric',
            'build_type' => 'required|numeric',
            'build_year' => 'required|numeric',
            'total_floor' => 'required|numeric',
            'floor_no' => 'required|numeric',
            'usage_type' => 'required|numeric',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        // Teklif talebini kaydet


        // Sonuç sayfasına yönlendir
        return redirect()->route('dask.sonuc');
    }

    public function sonuc()
    {
        $teklifler = session('dask_teklifler', []);

        if (empty($teklifler)) {
            return redirect()->route('dask.index')
                ->with('error', 'Teklif bilgileri bulunamadı. Lütfen tekrar deneyiniz.');
        }

        return view('backend.teklif-al.dask-sonuc', compact('teklifler'));
    }
}
