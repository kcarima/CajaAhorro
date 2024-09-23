<?php

namespace App\Livewire\Sca\ConversionMonetaria;

use App\Actions\SCA\ConversionMonetaria\BuscarConversionMonetaria;
use App\Models\SCA\ConversionMonetaria;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class ConversionMonetariaComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $conversiones = BuscarConversionMonetaria::handle($this->busqueda);

        return view('livewire.sca.conversion-monetaria.conversion-monetaria-component', ['conversiones' => $conversiones]);
    }

    #[On('conversion-monetaria:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('conversion-monetaria:delete')]
    public function delete(string $id)
    {

        abort_unless(auth()->user()->is_admin(), 404);

        try {
            $conversion = ConversionMonetaria::withCount(['historial'])->where('uuid', $id)->firstOrFail();

            if ($conversion->historial_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar una conversion monetaria que posea un registro en el historial.');
            } else {
                $conversion->delete();
                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: 'Conversion monetaria eliminada satisfactoriamente.');
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Conversion monetaria no encontrada.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la conversion monetaria.');

        }
        $this->dispatch('refresh-listeners');
    }

}
