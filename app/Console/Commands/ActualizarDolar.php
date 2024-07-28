<?php

namespace App\Console\Commands;

use App\Actions\Console\ActualizarDolarAction;
use Exception;
use Illuminate\Console\Command;

final class ActualizarDolar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actualizar:dolar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para actualizar la taza del dolar';

    /**
     * Execute the console command.
     */
    public function handle(ActualizarDolarAction $action)
    {
        try {
            $action->handle();
            $this->info('Tasa actualizada correctamente.');

            return Command::SUCCESS;
        } catch (Exception $e) {
            $this->error("Error al actualizar la tasa.\n {$e->getMessage()}");
            return Command::FAILURE;
        }
    }
}
