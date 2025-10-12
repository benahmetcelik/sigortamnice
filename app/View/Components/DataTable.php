<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    /**
     * Create a new component instance.
     */

    private string $id;
    private mixed $columns = [];

    public function __construct($id, $columns)
    {
        $this->id = $id;
        $this->columns = $columns;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-table', [
            'id' => $this->id,
            'columns' => $this->columns
        ]);
    }
}
