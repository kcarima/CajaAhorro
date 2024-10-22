<?php

namespace App\Livewire\Sca\CuentasBancarias;

use App\Actions\SCA\CuentasBancarias\BuscarCuentasBancarias;
use App\Models\SCA\CuentaBancaria;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class CuentasBancariasComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $cuentasBancarias = BuscarCuentasBancarias::handle($this->busqueda);

        return view('livewire.sca.cuentas-bancarias.cuentas-bancarias-component', ['cuentasBancarias' => $cuentasBancarias]);
    }

    #[On('cuenta-bancaria:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('cuenta-bancaria:delete')]
    public function delete(string $id)
    {

        abort_unless(auth()->user()->is_admin(), 404);

        try {
            $cuentaBancaria = CuentaBancaria::where('uuid', $id)->firstOrFail();
            $cuentaBancaria->delete();
            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: 'Cuenta bancaria eliminada satisfactoriamente.');

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Cuenta bancaria no encontrada.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la cuenta bancaria.');

        }
        $this->dispatch('refresh-listeners');
    }

    #[On('cuenta-bancaria:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $cuentaBancaria = CuentaBancaria::withTrashed()->where('uuid', $id)->firstOrFail();
            $cuentaBancaria->forceDelete();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: 'Cuenta bancaria eliminada completamente.');

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Cuenta bancaria no encontrada.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la cuenta bancaria.');

        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $cuentaBancaria = CuentaBancaria::withTrashed()->where('uuid', $id)->firstOrFail();
            $cuentaBancaria->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: 'Cuenta bancaria restaurada.');

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Cuenta bancaria no encontrada.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar la cuenta bancaria.');

        }
        $this->dispatch('refresh-listeners');
    }
}
