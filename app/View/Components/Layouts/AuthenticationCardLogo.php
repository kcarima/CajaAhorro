<?php

namespace App\View\Components\Layouts;

use App\Models\SCA\Configuracion;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthenticationCardLogo extends Component
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
        $logo = Configuracion::find('2')->valor;

        return view('components.layouts.authentication-card-logo', ['logo' => $logo]);
    }
}
