<?php

use App\Models\SiteSetting;
if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeName): string
    {
        return request()->routeIs($routeName) ? 'active' : '';
    }
}


if (!function_exists('isMenuActive')) {
    function isMenuActive($routeNames): string
    {
        $routeNames = (array)$routeNames;
        return collect($routeNames)->contains(fn($route) => request()->routeIs($route)) ? 'active' : '';
    }
}


if (!function_exists('variable')){
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function variable(string $key,mixed $default=''):mixed
    {
        $systemConfig = \App\Models\SystemConfig::where('config_key',$key)->first();
        if ($systemConfig){
            return $systemConfig->config_value;
        }
        \App\Models\SystemConfig::create([
            'config_key'=> $key,
            'config_value'=>$default,
            'config_type'=>gettype($default)
        ]);
        return $default;

    }
}



if (!function_exists('theme')){
   function theme(string $path,mixed $data = []):mixed
    {
        if (strlen(request()->theme_prefix) > 0){
            $path = 'themes.'.request()->theme_prefix.'.'.$path;
        }
        return view($path,$data);
    }
}



if (!function_exists('themeAssets')){
    function themeAssets(string|null $path=null):mixed
     {
         if (strlen(request()->theme_prefix) > 0){
             $path = 'themes/'.request()->theme_prefix.'/'.$path;
         }
         return asset($path);
     }
 }

 if (!function_exists('domainSettings')){
    function domainSettings(string $key, string|null $value=null):mixed
     {
        // TODO: Bu kısım daha sonrasında cache ile çağırılacak ve
        // bu verinin güncellendiği serviste de cache güncellemesi sağlanacak
         $settings = SiteSetting::firstOrCreate([
            'config_key'=> $key,
            'domain_id'=>request()->finded_domain->id
         ],[
            'config_value'=>$value,
            'config_type'=>gettype($value) // TODO: bu kısım bool değerleri string sanıyor
         ]);
         return $settings->config_value ?? $value;
     }
 }




if (!function_exists('domain')){
    function domain():mixed
    {
       return \App\Models\Domain::current();
    }
}


function formBuilder()
{
    return new \ludovicm67\FormBuilder();
}





if (!function_exists('module_view')){
    function module_view(string $path,mixed $data = []):mixed
    {
        if (strlen(request()->theme_prefix) > 0){
            $path = 'themes.'.request()->theme_prefix.'.modules.'.$path;
        }
        return view($path,$data);
    }
}
