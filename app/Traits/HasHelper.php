<?php

namespace App\Traits;


use Illuminate\Http\Request;

trait HasHelper
{

    public static function getTableHeaders()
    {
        $headers = self::$tableHeaders ?? [];
        if (!empty($headers)) {
            return $headers;
        }
        $filleable = self::$filleable;
        foreach ($filleable as $item) {
            $headers[$item] = $item;
        }
        return $headers;
    }

    public function getActionsAttribute()
    {

    }

    public function getHtmlStatusAttribute()
    {
        return $this->status ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>';
    }

    public function getHtmlImageAttribute()
    {
        return '<img src="'.asset($this->image_path).'" alt="" srcset="">';
    }

    public function getModelName()
    {
        $array = explode('\\', __CLASS__);
        return strtolower(end($array));
    }

    public function getInputs()
    {
        return $this->inputs;
    }


    public function getCreateRoute()
    {
        return 'admin.'.strtolower($this->getModelName()).'.store';
    }

    public function getUpdateRoute()
    {
        return 'admin.'.strtolower($this->getModelName()).'.update';
    }
    public function getEditRoute()
    {
        return 'admin.'.strtolower($this->getModelName()).'.edit';
    }

    public function getDeleteRoute()
    {
        return 'admin.'.strtolower($this->getModelName()).'.delete';
    }

    public function getButtons($id=null)
    {
        $buttons = $this->buttons;
        $htmls = [];
        foreach ($buttons ?? [] as $button){
            $method = 'get'.ucfirst($button).'Button';
            if (method_exists($this,$method)){
                $htmls[] = $this->{$method}($id);
            }
        }
        return $htmls;
    }

    public function getEditButton($id=null)
    {
        if(is_null($id)){
            $id = $this->id;
        }
        return '<a class="dropdown-item" href="'.route($this->getEditRoute(),$id).'">Düzenle</a>';
    }

    public function getDeleteButton($id=null)
    {
        if(is_null($id)){
            $id = $this->id;
        }
        return '<a class="dropdown-item" href="'.route($this->getDeleteRoute(),$id).'">Sil</a>';
    }
}
