<?php

namespace App\Services\UiServices;

use App\Models\Domain;
use App\Models\Theme;
use App\Models\UiModule;
use App\Modules\Modules;


class ModuleService{



    public static function render(){
        /**
         * @var UiModule $ui_module;
         */
        $ui_modules = request()->ui_modules;
        $html = "";
        foreach($ui_modules as $ui_module){
            if($module = self::loadModule($ui_module->themeModule?->path)){
               $html .= $module->getOutput();
            }
        }
        return $html;

    }


    public static function loadModule($module_path){
       $module =  Modules::getModuleByName($module_path);
        if($module !== false){
            $module = new $module;
            $module->load();
        }
        return $module;
    }

}
