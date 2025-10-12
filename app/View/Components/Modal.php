<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{

    private string $id;
    private string $title;

    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal', [
            'id' => $this->id,
            'title' => $this->title
        ]);
    }
}
