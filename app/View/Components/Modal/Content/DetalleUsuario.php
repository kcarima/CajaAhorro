<?php

namespace App\View\Components\Modal\Content;

use App\Models\Seguridad\User;
use Illuminate\View\Component;

class DetalleUsuario extends Component
{
    public $usuario;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($usuario)
    {
        $this->usuario = User::withTrashed()->where('ficha', $usuario)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.content.detalle-usuario');
    }
}
