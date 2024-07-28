<?php

namespace App\Livewire\Sca\TipoPrestamo;

use App\Actions\SCA\TipoPrestamo\BuscarTipoPrestamo;
use App\Models\SCA\TipoPrestamo;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class TipoPrestamoComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $tiposPrestamos = BuscarTipoPrestamo::handle($this->busqueda);

        return view('livewire.sca.tipo-prestamo.tipo-prestamo-component', ['tiposPrestamos' => $tiposPrestamos]);
    }

    #[On('tipo-prestamo:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('tipo-prestamo:delete')]
    public function delete(string $id)
    {

        abort_unless(auth()->user()->is_admin(), 404);

        try {
            $tipoPrestamo = TipoPrestamo::withCount(['prestamos'])->where('uuid', $id)->firstOrFail();
            if ($tipoPrestamo->prestamos_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un tipo de prestamo utilizado por un prestamo.');
            } else {
                $tipoPrestamo->delete();
                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: 'Tipo de prestamo eliminado satisfactoriamente.');
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el tipo de prestamo.');

        }
        $this->dispatch('refresh-listeners');
    }

    #[On('tipo-prestamo:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $tipoPrestamo = TipoPrestamo::withTrashed()->withCount(['prestamos'])->where('uuid', $id)->firstOrFail();
            if ($tipoPrestamo->prestamos_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un tipo de prestamo utilizado por un prestamo.');
            } else {
                $tipoPrestamo->forceDelete();
                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: 'Tipo de prestamo eliminado satisfactoriamente.');
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el tipo de prestamo.');

        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $tipoPrestamo = TipoPrestamo::withTrashed()->where('uuid', $id)->firstOrFail();
            $tipoPrestamo->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: 'Cuenta bancaria restaurada.');

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar el tipo de prestamo.');

        }
        $this->dispatch('refresh-listeners');
    }
}
