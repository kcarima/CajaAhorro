<?php

namespace App\Console\Commands;

use App\Actions\Console\VaciarPapeleraAction;
use Exception;
use Illuminate\Console\Command;

final class VaciarPapelera extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaciar:papelera';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para eliminar de la base de datos los registros con mas de 30 dias eliminados (softdelete)';

    /**
     * Execute the console command.
     */
    public function handle(VaciarPapeleraAction $action)
    {
        try {
            $action->handle();
            $this->info('Limpieza de la base de datos realizada con exito.');

            return Command::SUCCESS;

        } catch (Exception $e) {
            $this->error("Error al limpiar la base de datos.\n {$e->getMessage()}");
            return Command::FAILURE;
        }
    }
}
