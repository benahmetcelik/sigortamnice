<?php

namespace App\Modules\Layout;

use App\Modules\BaseModule\IModuleInterface;
use App\Modules\BaseModule\Module;

class Footer extends Module implements IModuleInterface
{

    public function getOutput()
    {
        return module_view('layout.footer',[
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
