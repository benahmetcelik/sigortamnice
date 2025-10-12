<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DaskProxyController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * DASK adres kodu hesaplama isteğini proxy olarak yönlendirir
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculateAddressCode(Request $request)
    {
        $paths = [
            'ilce'=>'ilce?json=Y&q=',
            'bucak'=>'bucakSorgu?json=Y&q=',
            'mahalle'=>'mahalleSorgu?json=Y&q=',
            'sokak'=>'sokakSorgu?json=Y&q=',
            'bina'=>'binaSorgu?json=Y&q=',
            'daire'=>'bagimsizBolumSorgu?json=Y&q='
        ];

        if (array_key_exists($request->search_type, $paths)) {
            $response = Http::post('https://www.hdisigorta.com.tr/uavt/'.$paths[$request->search_type].$request->search_value);
            return $response->body();
        }

        return response()->json([]);
    }

    /**
     * DASK adres kodu hesaplama yanıtını proxy olarak yönlendirir
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculateAddressCodeResponse(Request $request)
    {
        Log::info('DASK calculateAddressCodeResponse isteği alındı', [
            'request_data' => $request->all(),
            'headers' => $request->headers->all()
        ]);

        $response = Http::withHeaders([
            'Origin' => 'referanssigorta.net',
            'Referer' => 'referanssigorta.net',
        ])->post('https://referanssigorta.net/dask-address-code-calculate-response', $request->except('_token'));

        return $response->json();
    }
}
