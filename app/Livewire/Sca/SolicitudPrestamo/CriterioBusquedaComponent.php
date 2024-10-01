<?php

namespace App\Livewire\Sca\SolicitudPrestamo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SCA\TipoPrestamo;
//

use Livewire\Component;

class CriterioBusquedaComponent extends Component
{
    use HasFactory;
    public $busqueda = [
        'fecha_solicitud' => '',
        'tipo_prestamo' => '',
        'socio' => '',
        'moneda' => '',
        'estatus' => ''
    ];

    public $tiposPrestamos = "";

    public function render(){
        $this->tiposPrestamos = TipoPrestamo::all();
        return view('livewire.sca.solicitud-prestamo.criterio-busqueda', ['tiposPrestamos' => $this->tiposPrestamos]);
    }

    public function updateBus(){
        $this->dispatch('valor-cambiado', busqueda: $this->busqueda);
    }    
}
