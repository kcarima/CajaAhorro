<?php

namespace App\View\Components\Layouts;

use App\Models\SCA\Configuracion;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $siglas_sistema = Configuracion::where('clave', 'like', 'Siglas Sistema')->first(['valor']);
        $logo_sistema = Configuracion::where('clave', 'like', 'Logo Sistema')->first(['valor']);

        return view('components.layouts.sidebar', ['siglas_sistema' => $siglas_sistema, 'logo_sistema' => $logo_sistema]);
    }
}
