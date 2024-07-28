<?php

namespace App\Livewire\Sca\TiposCuentas;

use App\Actions\SCA\TiposCuentasBancarias\BuscarTiposCuentasBancarias;
use App\Models\SCA\TipoCuentaBancaria;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class TiposCuentasBancariasComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $tipos_cuentas = BuscarTiposCuentasBancarias::handle($this->busqueda);

        return view('livewire.sca.tipos-cuentas.tipos-cuentas-bancarias-component', ['tipos_cuentas' => $tipos_cuentas]);
    }

    #[On('tipos-cuentas:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('tipos-cuentas:delete')]
    public function delete(string $id)
    {

        abort_unless(auth()->user()->is_admin(), 404);

        try {
            $tipo_cuenta = TipoCuentaBancaria::withCount(['bancos_socios', 'cuentas_bancarias'])->where('uuid', $id)->firstOrFail();

            if ($tipo_cuenta->bancos_socios_count > 0 || $tipo_cuenta->cuentas_bancarias_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un tipo de cuenta bancaria ocupado por una cuenta bancaria.');
            } else {
                $nombre = $tipo_cuenta->nombre;
                $tipo_cuenta->delete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Tipo de cuenta bancaria $nombre eliminado satisfactoriamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Tipo de cuenta bancaria no encontrado.');

        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el tipo de cuenta bancaria.');

        }
        $this->dispatch('refresh-listeners');
    }

    #[On('tipos-cuentas:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $tipo_cuenta = TipoCuentaBancaria::withTrashed()->where('uuid', $id)->withCount(['bancos_socios', 'cuentas_bancarias'])->firstOrFail();

            if ($tipo_cuenta->bancos_socios_count > 0 || $tipo_cuenta->cuentas_bancarias_count > 0) {

                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un tipo de cuenta bancaria ocupado por una cuenta bancaria.');

            } else {

                $nombre = $tipo_cuenta->nombre;
                $tipo_cuenta->forceDelete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Tipo de cuenta bancaria $nombre eliminado completamente.");

            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Tipo de cuenta bancaria no encontrado.');

        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el tipo de cuenta.');

        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {

            $tipo_cuenta = TipoCuentaBancaria::withTrashed()->where('uuid', $id)->firstOrFail();

            $tipo_cuenta->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Tipo de cuenta bancaria $tipo_cuenta->nombre restaurado.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Tipo de cuenta bancaria no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar el tipo de cuenta bancaria.');

        }
        $this->dispatch('refresh-listeners');
    }
}
