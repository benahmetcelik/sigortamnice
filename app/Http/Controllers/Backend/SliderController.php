<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\HasCrud;

class SliderController extends Controller
{
    use HasCrud;

    protected $model = Slider::class;
    protected $viewBase = 'backend.slider.';
    protected $routeBase = 'admin.slider.';

    public function __construct()
    {
        $this->middleware('auth');
    }
}
