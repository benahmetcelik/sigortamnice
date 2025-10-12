<?php

namespace App\Modules\CustomComponents;

use App\Modules\BaseModule\IModuleInterface;
use App\Modules\BaseModule\Module;

class ClientCommentsModule extends Module implements IModuleInterface
{

    public function getOutput()
    {
        return module_view('custom.components.client-comments',[
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
