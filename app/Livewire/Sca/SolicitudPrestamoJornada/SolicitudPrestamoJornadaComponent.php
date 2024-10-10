<?php

namespace App\Livewire\Sca\SolicitudPrestamoJornada;

use App\Models\SCA\SolicitudPrestamoJornada;
use App\Models\SCA\SolicitudPrestamoJornadaDetalle;

use Livewire\Component;
use Livewire\WithPagination;

class SolicitudPrestamoJornadaComponent extends Component
{
    use WithPagination;
    public $jornadas;
    
    public function render()
    {
        $this->jornadas = SolicitudPrestamoJornada::all();
        return view('livewire.sca.solicitud-prestamo-jornada.solicitud-prestamo-jornada-component', ['jornadas' => $this->jornadas]);
    }
}
