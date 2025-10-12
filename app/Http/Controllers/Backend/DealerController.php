<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Domain;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dealers = Dealer::latest()->paginate(10);
        return view('backend.dealers.index', compact('dealers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $domains = Domain::all();
        return view('backend.dealers.create', compact('domains'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:dealers',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'domain_id' => 'required|exists:domains,id',
        ]);

        Dealer::create($request->all());

        return redirect()->route('admin.dealers.index')
            ->with('success', 'Bayi başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dealer $dealer)
    {
        return view('backend.dealers.show', compact('dealer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dealer $dealer)
    {
        $domains = Domain::all();
        return view('backend.dealers.edit', compact('dealer', 'domains'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dealer $dealer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:dealers,email,' . $dealer->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        $dealer->update($request->all());

        return redirect()->route('admin.dealers.index')
            ->with('success', 'Bayi başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dealer $dealer)
    {
        $dealer->delete();

        return redirect()->route('admin.dealers.index')
            ->with('success', 'Bayi başarıyla silindi.');
    }
}
