<?php

namespace App\Livewire\Uneg\TiposTrabajadores;

use App\Actions\UNEG\TiposTrabajadores\BuscarTiposTrabajadores;
use App\Models\UNEG\TipoTrabajador;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class TiposTrabajadoresComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $tipos_trabajadores = BuscarTiposTrabajadores::handle($this->busqueda);

        return view('livewire.uneg.tipos-trabajadores.tipos-trabajadores-component', ['tipos_trabajadores' => $tipos_trabajadores]);
    }

    #[On('tipos-trabajadores:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('tipos-trabajadores:delete')]
    public function delete(string $id)
    {
        try {
            $tipo_trabajador = TipoTrabajador::withCount(['socios'])->where('uuid', $id)->firstOrFail();

            if ($tipo_trabajador->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un tipo trabajador ocupado por socios.');
            } else {
                $nombre = $tipo_trabajador->nombre;
                $tipo_trabajador->delete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Tipo trabajador $nombre eliminado satisfactoriamente.");
            }
        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el tipo trabajador.');
        }
        $this->dispatch('refresh-listeners');
    }

    #[On('tipos-trabajadores:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $tipo_trabajador = TipoTrabajador::withTrashed()->withCount(['socios'])->where('uuid', $id)->firstOrFail();

            if ($tipo_trabajador->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un tipo trabajador ocupado por socios.');
            } else {
                $nombre = $tipo_trabajador->nombre;
                $tipo_trabajador->forceDelete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Tipo de trabajador $nombre eliminado satisfactoriamente.");
            }
        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el tipo trabajador.');
        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $tipo_trabajador = TipoTrabajador::withTrashed()->where('uuid', $id)->firstOrFail();

            $tipo_trabajador->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Tipo de trabajador $tipo_trabajador->nombre restaurado.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Tipo de trabajador no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar el tipo de trabajador.');

        }
        $this->dispatch('refresh-listeners');
    }
}
