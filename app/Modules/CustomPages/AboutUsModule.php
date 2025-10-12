<?php


namespace App\Modules\CustomPages;

use App\Modules\BaseModule\IModuleInterface;
use App\Modules\BaseModule\Module;

class AboutUsModule extends Module implements IModuleInterface
{

    public function getOutput()
    {
        return module_view('custom_pages.about_us',[
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
