<?php

namespace App\Traits;


use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

trait HasCrud
{


    public function index()
    {
        $model = new $this->model;
        $items = $model->orderBy('id','desc')->get();
        return view($this->viewBase . 'index', compact('items', 'model'));
    }

    public function create()
    {
        $model = $this->model;
        return view($this->viewBase . 'create', compact('model'));
    }

    public function store(Request $request)
    {
        $request->request->remove('_token');
        $item = new ($this->model);
        foreach ($request->toArray() as $key => $value) {
            if ($value instanceof UploadedFile) {
                $extension = $value->getClientOriginalExtension();
                $filename = now()->timestamp . '.' . $extension;
                $item->{$key} = $value->move(
                    public_path('uploads/' . domain()->id . '/'),
                    $filename
                );
            } else {
                $item->{$key} = $value;
            }
        }
        $item->save();
        return redirect()->route($this->routeBase . 'index')->with('success', 'Başarıyla eklendi.');
    }


    public function edit($id)
    {
        $model = $this->model::find($id);
        return view($this->viewBase . 'edit', compact('model'));

    }

    public function update(Request $request, $id)
    {
        $request->request->remove('_token');
        $item = $this->model::find($id);
        foreach ($request->toArray() as $key => $value) {
            if ($value instanceof UploadedFile) {
                $extension = $value->getClientOriginalExtension();
                $filename = now()->timestamp . '.' . $extension;
                $item->{$key} = $value->move(
                    public_path('uploads/' . domain()->id . '/'),
                    $filename
                );
            } else {
                $item->{$key} = $value;
            }
        }
        $item->save();
        return redirect()->route($this->routeBase . 'index')->with('success', 'Başarıyla güncellendi.');
    }


    public function destroy($id)
    {
        $item = $this->model::find($id);
        $item->delete();
        return redirect()->route($this->routeBase . 'index')->with('success', 'Başarıyla silindi.');
    }
}
