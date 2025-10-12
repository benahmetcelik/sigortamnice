<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\DomainModule;
use App\Models\WebService;
use Illuminate\Http\Request;

class DomainModuleController extends Controller
{
    public function index($id)
    {
        $domain = Domain::with(['modules', 'webServices.modules'])->find($id);

        if (!$domain) {
            return redirect()->route('backend.domains.index')->with('error', 'Domain Bulunamadı');
        }

        $domain->webServices = $domain->webServices->map(function ($webService) use ($domain) {
            $webService->modules = $webService->modules->map(function ($module) use ($domain, $webService) {
                // DomainModule var mı kontrol ediliyor.
                $module->selected = DomainModule::where([
                    ['domain_id', $domain->id],
                    ['web_service_id', $webService->id],
                    ['web_service_module_id', $module->id]
                ])->exists();

                return $module;
            });

            return $webService;
        });

        $webServices = WebService::with('modules')->get();
        return view('backend.domain-module.index', compact('domain','webServices'));
    }

    public function addModule(Request $request)
    {
        $this->validate($request, [
            'domain_id' => 'required|integer',
            'web_service_id' => 'required|integer',
            'web_service_module_id' => 'required|integer',
        ]);

        $domain = Domain::find($request->domain_id);
        if (!$domain) {
            return redirect()->route('backend.domains.index')->with('error', 'Domain Bulunamadı');
        }

        $webService = WebService::find($request->web_service_id);
        if (!$webService) {
            return redirect()->route('backend.domains.index')->with('error', 'Web Servis Bulunamadı');
        }

        $module = $webService->modules()->find($request->web_service_module_id);
        if (!$module) {
            return redirect()->route('backend.domains.index')->with('error', 'Modül Bulunamadı');
        }

        $domainModule = new DomainModule();
        $domainModule->domain_id = $request->domain_id;
        $domainModule->web_service_id = $request->web_service_id;
        $domainModule->web_service_module_id = $request->web_service_module_id;
        $domainModule->save();
        return redirect()->route('admin.domain-modules.index', $request->domain_id)->with('success', 'Modül Eklendi');
    }
    public function updateModule(Request $request)
    {
        // Gelen veriyi doğrulama
        $this->validate($request, [
            'id' => 'required|integer', // Güncellenecek DomainModule ID'si
            'web_service_id' => 'required|integer',
            'web_service_module_id' => 'required|integer',
            'domain_id' => 'required|integer', // Domain ID doğrulaması
        ]);

        // Güncellenecek modülü bul
        $domainModule = DomainModule::find($request->id);
        if (!$domainModule) {
            return redirect()->route('admin.domain-modules.index')->with('error', 'Modül Bulunamadı');
        }

        // İlişkili domain kontrolü
        $domain = Domain::find($request->domain_id);
        if (!$domain) {
            return redirect()->route('backend.domains.index')->with('error', 'Domain Bulunamadı');
        }

        // Domain'e aitlik kontrolü
        if ($domainModule->domain_id !== $domain->id) {
            return redirect()->route('backend.domains.index')->with('error', 'Bu modül belirtilen domaine ait değil.');
        }

        // Web Servis kontrolü
        $webService = WebService::find($request->web_service_id);
        if (!$webService) {
            return redirect()->route('backend.domains.index')->with('error', 'Web Servis Bulunamadı');
        }

        // Modül kontrolü
        $module = $webService->modules()->find($request->web_service_module_id);
        if (!$module) {
            return redirect()->route('backend.domains.index')->with('error', 'Modül Bulunamadı');
        }

        // Güncelleme işlemi
        $domainModule->web_service_id = $request->web_service_id;
        $domainModule->web_service_module_id = $request->web_service_module_id;
        $domainModule->save();
        return redirect()->route('admin.domain-modules.index', $domain->id)->with('success', 'Modül Güncellendi');
    }

    public function deleteModule($id)
    {
        $domainModule = DomainModule::find($id);
        if (!$domainModule) {
            return redirect()->route('admin.domain-modules.index')->with('error', 'Modül Bulunamadı');
        }

        $domainModule->delete();
        return redirect()->route('admin.domain-modules.index', $domainModule->domain_id)->with('success', 'Modül Silindi');
    }

    public function updateSettings(Request $request)
    {
        $settings = [];
        $domainModule = DomainModule::find($request->module_id);
        if (!$domainModule) {
            return redirect()->route('admin.domain-modules.index')->with('error', 'Modül Bulunamadı');
        }

        $domain = Domain::find($domainModule->domain_id);
        if (!$domain) {
            return redirect()->route('backend.domains.index')->with('error', 'Domain Bulunamadı');
        }

        // Domain'e aitlik kontrolü
        if ($domainModule->domain_id !== $domain->id) {
            return redirect()->route('backend.domains.index')->with('error', 'Bu modül belirtilen domaine ait değil.');
        }

        $request->request->remove('_token');
        $request->request->remove('module_id');
        $request->request->remove('domain_id');
        foreach ($request->keys() as $key) {
            $settings[] = [
                'key' => $key,
                'value' => $request->get($key)
            ];
        }

        $domainModule->settings = $settings;
        $domainModule->save();
        return redirect()->route('admin.domain-modules.index', $domain->id)->with('success', 'Ayarlar Güncellendi');
    }


}
