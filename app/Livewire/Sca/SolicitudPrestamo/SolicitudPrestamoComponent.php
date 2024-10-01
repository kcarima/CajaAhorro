<?php

namespace App\Livewire\Sca\SolicitudPrestamo;

use App\Models\SCA\SolicitudPrestamo;

use Livewire\Component;

class SolicitudPrestamoComponent extends Component
{
    public $filtro = [
        'fecha_solicitud' => '',
        'tipo_prestamo' => '',
        'socio' => '',
        'moneda' => '',
        'estatus' => ''
    ];

    public function render()
    {
        $solicitudes = SolicitudPrestamo::all();//BuscarSolicitudPrestamo::handle($this->busqueda);
        return view('livewire.sca.solicitud-prestamo.solicitud-prestamo-component', ['solicitudes' => $solicitudes]);
    }

    #[On('valor-cambiado')]
    public function busqueda($busqueda)
    {
        $query = "select 	a.id,a.ficha,a.fecha_solicitud,b.nombre tipo_prestamo,c.abreviatura,a.monto,a.status
                  from 	sca.solicitud_prestamo a
                        left join sca.tipos_prestamos b on a.tipo_prestamo=b.id
                        left join sca.monedas c on a.moneda=c.id
                  order by 3 desc";
                          
        $this->filtro = $busqueda;
        $this->dispatch('refresh-listeners');
    }
}
