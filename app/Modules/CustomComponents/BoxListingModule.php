<?php

namespace App\Modules\CustomComponents;

use App\Modules\BaseModule\IModuleInterface;
use App\Modules\BaseModule\Module;

class BoxListingModule extends Module implements IModuleInterface
{

    public function getOutput()
    {
        return module_view('custom.components.box-listing',[
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
