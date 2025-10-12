<?php

namespace App\Modules\CustomComponents;

use App\Models\Slider as SliderModel;
use App\Modules\BaseModule\IModuleInterface;
use App\Modules\BaseModule\Module;

class Slider extends Module implements IModuleInterface
{
    public function getOutput()
    {
        $sliders = SliderModel::where('status', true)
            ->orderBy('order', 'asc')
            ->get();

        return module_view('custom.components.slider', [
            'sliders' => $sliders
        ]);
    }

    public function load()
    {
        // Slider verilerini yükle
    }
}
