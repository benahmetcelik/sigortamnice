<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Dealer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('dealer')
            ->when(\request('dealer_id'), function ($query, $dealer_id) {
                return $query->where('dealer_id', $dealer_id);
            })
            ->latest()->paginate(10);
        return view('backend.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dealers = Dealer::where('status', 'active')->get();
        return view('backend.customers.create', compact('dealers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dealer_id' => 'required|exists:dealers,id',
            'name' => 'required|string|max:255',
            'tc_no' => 'nullable|string|size:11|unique:customers,tc_no',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'status' => 'required|in:active,passive',
            'address' => 'required|string',
        ]);

        Customer::create($request->all());

        return redirect()->route('admin.customers.index')
            ->with('success', 'Müşteri başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('backend.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $dealers = Dealer::where('status', 'active')->get();
        return view('backend.customers.edit', compact('customer', 'dealers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'dealer_id' => 'required|exists:dealers,id',
            'name' => 'required|string|max:255',
            'tc_no' => 'nullable|string|size:11|unique:customers,tc_no,' . $customer->id,
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'status' => 'required|in:active,passive',
            'address' => 'required|string',
        ]);

        $customer->update($request->all());

        return redirect()->route('admin.customers.index')
            ->with('success', 'Müşteri başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Müşteri başarıyla silindi.');
    }

    /**
     * Telefon numarasına göre müşteri arama
     */
    public function search(Request $request)
    {
        $phone = $request->input('phone');

        if (empty($phone)) {
            return response()->json([
                'success' => false,
                'message' => 'Telefon numarası gereklidir.'
            ]);
        }

        $customer = Customer::where('phone', $phone)->first();

        if ($customer) {
            return response()->json([
                'success' => true,
                'customer' => $customer
            ]);
        } else {
            return response()->json([
                'success' => true,
                'customer' => null,
                'message' => 'Müşteri bulunamadı.'
            ]);
        }
    }
}
