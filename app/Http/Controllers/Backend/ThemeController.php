<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Theme;
use App\Models\UiModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ThemeController extends Controller
{

    public function index()
    {
        $items = Theme::latest()->get();
        return view('backend.themes.index', compact('items'));
    }

    public function select(Theme $theme)
    {
        $domain = Domain::current();
        $domain->theme_id = $theme->id;
        $domain->save();
        return redirect()->route('admin.themes.index')->with('success', 'Tema başarıyla güncellendi.');
    }

    public function modules(Theme $theme)
    {
        $items = $theme->themeModules()->with('uiModule')->get();
        return view('backend.themes.modules.index', compact('items'));
    }

    public function moduleOpen(Theme $theme,UiModule $uiModule)
    {
        $uiModule->update([
            'status' => 1
        ]);
        $host = \request()->getHost();
        $cacheKey = 'domain_information_'.$host;
        Cache::forget($cacheKey);
        return redirect()->back()->with('success','Başarıyla aktif edildi');
    }

    public function moduleClose(Theme $theme,UiModule $uiModule)
    {

        $uiModule->update([
            'status' => 0
        ]);
        $host = \request()->getHost();
        $cacheKey = 'domain_information_'.$host;
        Cache::forget($cacheKey);
        return redirect()->back()->with('success','Başarıyla aktif edildi');
    }

}
