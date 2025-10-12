<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class AllowedDomainController extends Controller
{
    public function index()
    {
        $domains = Domain::latest()->get();
        $themes = Theme::latest()->get();
        return view('backend.allowed_domain.index', compact('domains', 'themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'domain' => 'required',
            'expires_at' => 'required',
            'status' => 'required'
        ]);

        if (Domain::where('domain', $request->domain)->exists()) {
            return redirect()->route('admin.allowed-domains.index')->with('error', 'Domain zaten ekli.');
        }
        $theme = Theme::first();
        Domain::create([
            'domain' => $request->domain,
            'expires_at' => $request->expires_at,
            'status' => $request->status,
            'theme_id' => $theme->id
        ]);
        return redirect()->route('admin.allowed-domains.index')->with('success', 'Domain başarıyla eklendi.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'expires_at' => 'required',
            'status' => 'required',
            'id' => 'required',
            'domain' => 'required'
        ]);

        $domain = Domain::find($request->id);
        if (!$domain) {
            return redirect()->route('admin.allowed-domains.index')->with('error', 'Domain bulunamadı.');
        }
        if ($domain->domain != $request->domain) {
            if (Domain::where('domain', $request->domain)->exists()) {
                return redirect()->route('admin.allowed-domains.index')->with('error', 'Domain zaten ekli.');
            }
        }
        $domain->update([
            'expires_at' => $request->expires_at,
            'status' => $request->status,
            'domain' => $request->domain
        ]);
        return redirect()->route('admin.allowed-domains.index')->with('success', 'Domain başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $domain = Domain::find($id);
        if (!$domain) {
            return redirect()->route('admin.allowed-domains.index')->with('error', 'Domain bulunamadı.');
        }
        $domain->delete();
        return redirect()->route('admin.allowed-domains.index')->with('success', 'Domain başarıyla silindi.');
    }

    public function users($id)
    {
        $allowedDomain = Domain::with('users')->findOrFail($id);
        $users = User::latest()->get();
        return view('backend.allowed_domain.users', compact('allowedDomain', 'users'));
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'domain_id' => 'required'
        ]);

        $domain = Domain::find($request->domain_id);
        if (!$domain) {
            return redirect()->route('admin.allowed-domains.index')->with('error', 'Domain bulunamadı.');
        }
        $domain->users()->attach($request->user_id);
        return redirect()->route('admin.allowed-domains.users', $request->domain_id)->with('success', 'Kullanıcı başarıyla eklendi.');
    }


    public function removeUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'domain_id' => 'required'
        ]);

        $domain = Domain::find($request->domain_id);
        if (!$domain) {
            return redirect()->route('admin.allowed-domains.index')->with('error', 'Domain bulunamadı.');
        }
        $domain->users()->detach($request->user_id);
        return redirect()->route('admin.allowed-domains.users', $request->domain_id)->with('success', 'Kullanıcı başarıyla silindi.');
    }

    public function selectTheme(Request $request)
    {
        $request->validate([
            'domain_id' => 'required',
            'theme_id' => 'required'
        ]);

        $domain = Domain::find($request->domain_id);
        if (!$domain) {
            return redirect()->route('admin.allowed-domains.index')->with('error', 'Domain bulunamadı.');
        }
        $domain->theme_id = $request->theme_id;
        $domain->save();
        return redirect()->route('admin.allowed-domains.index')->with('success', 'Tema başarıyla güncellendi.');
    }

}
