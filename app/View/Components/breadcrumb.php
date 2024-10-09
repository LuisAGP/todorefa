<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class breadcrumb extends Component
{
    public $rutas;

    public function __construct($rutas)
    {
        $this->rutas = $rutas;
    }

    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
