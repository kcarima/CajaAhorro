<?php

namespace App\Livewire\Uneg\RelacionesLaborales;

use App\Actions\UNEG\RelacionesLaborales\BuscarRelacionesLaborales;
use App\Models\UNEG\RelacionLaboral;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class RelacionesLaboralesComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $relaciones_laborales = BuscarRelacionesLaborales::handle($this->busqueda);

        return view('livewire.uneg.relaciones-laborales.relaciones-laborales-component', ['relaciones_laborales' => $relaciones_laborales]);
    }

    #[On('relaciones-laborales:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('relaciones-laborales:delete')]
    public function delete(string $id)
    {

        try {
            $relacion_laboral = RelacionLaboral::withCount(['socios'])->where('uuid', $id)->firstOrFail();

            if ($relacion_laboral->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar una relación laboral ocupado por socios.');
            } else {
                $nombre = $relacion_laboral->nombre;
                $relacion_laboral->delete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Relación laboral $nombre eliminado satisfactoriamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Relación laboral no encontrado.');

        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la relación laboral.');

        }
        $this->dispatch('refresh-listeners');
    }

    #[On('relaciones-laborales:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $relacion_laboral = RelacionLaboral::withTrashed()->withCount(['socios'])->where('uuid', $id)->fistOrFail();
            if ($relacion_laboral->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar una relación laboral ocupado por socios.');
            } else {
                $nombre = $relacion_laboral->nombre;
                $relacion_laboral->forceDelete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Relación laboral $nombre eliminado satisfactoriamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Relación laboral no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la relación laboral.');

        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $relacion_laboral = RelacionLaboral::withTrashed()->where('uuid', $id)->firstOrFail();

            $relacion_laboral->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Relacion laboral $relacion_laboral->nombre restaurado.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Relación laboral no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar la relación laboral.');

        }
        $this->dispatch('refresh-listeners');
    }
}
