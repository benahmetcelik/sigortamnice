<?php

namespace App\Modules\GeneralComponents;

use App\Modules\BaseModule\IModuleInterface;
use App\Modules\BaseModule\Module;

class DetailModule extends Module implements IModuleInterface
{

    public function getOutput()
    {
        return module_view('general.components.detail',[
            'title'=>$this->title,
            'description'=>$this->description
        ]);
    }

    public function load()
    {
        $this->title = domainSettings('site_title','NiceYazılım');
        $this->description =  domainSettings('site_description','NiceYazılım');
    }
}
