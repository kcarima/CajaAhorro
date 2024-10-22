<?php

namespace App\Livewire\Uneg\Cargos;

use App\Actions\UNEG\Cargos\BuscarCargos;
use App\Models\UNEG\Cargo;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class CargosComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $cargos = BuscarCargos::handle($this->busqueda);

        return view('livewire.uneg.cargos.cargos-component', ['cargos' => $cargos]);
    }

    #[On('cargos:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('cargos:delete')]
    public function delete(string $id)
    {

        abort_unless(auth()->user()->is_admin(), '403');

        try {
            $cargo = Cargo::where('uuid', $id)->withCount(['socios'])->firstOrFail();

            if ($cargo->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un cargo ocupado por socios.');
            } else {
                $nombre = $cargo->nombre;
                $codigo = $cargo->codigo;
                $cargo->delete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Cargo $nombre ($codigo) eliminado satisfactoriamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Cargo no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el cargo.');

        }
        $this->dispatch('refresh-listeners');
    }

    #[On('cargos:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $cargo = Cargo::withTrashed()->where('uuid', $id)->withCount(['socios'])->firstOrFail();
            if ($cargo->socio_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un cargo ocupado por socios.');
            } else {
                $nombre = $cargo->nombre;
                $codigo = $cargo->codigo;
                $cargo->forceDelete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Cargo $nombre ($codigo) eliminado completamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Cargo no encontrado.');

        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el cargo.');

        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $cargo = Cargo::withTrashed()->where('uuid', $id)->firstOrFail();

            $cargo->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Cargo $cargo->nombre ($cargo->codigo) restaurado exitosamente.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Cargo no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar el cargo.');

        }
        $this->dispatch('refresh-listeners');
    }
}
