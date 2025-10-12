<?php

namespace App\Http\Middleware;

use App\Models\Domain;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class CheckDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();


        $cacheKey = 'domain_information_'.$host;

        /**
         * @var Domain $isDomainAllowed
         */
        // Cache'den domain durumunu kontrol et
        $isDomainAllowed = Cache::remember($cacheKey, 1, function () use ($host) {
            return Domain::where('domain', $host)
                ->where('status', true)
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                ->with('theme')
                ->first();
        });

        if (!$isDomainAllowed) {
            // Eğer AJAX isteği ise JSON yanıt döndür
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Bu domain için erişim yetkiniz bulunmamaktadır.',
                    'code' => 403
                ], 403);
            }

            // Normal istek ise hata sayfasına yönlendir
            return response()->view('backend.error.error_domain', [], 403);
        }
        $request->finded_theme = $isDomainAllowed->theme;
        $request->theme_prefix = $isDomainAllowed->theme->path;
        $request->theme_id = $isDomainAllowed->theme->id;
        $request->finded_domain = $isDomainAllowed->getModel();







        View::getFinder()->prependLocation(resource_path("views/themes/{$request->finded_theme->path}"));
        return $next($request);
    }
}
