<?php

namespace App\Console\Commands;

use App\Actions\Console\ResetPassword as ConsoleResetPassword;
use Illuminate\Console\Command;

final class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pass:reset {--all} {--cedula=} {--cedulas=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reiniciar la contraseña de los usuarios del sistema';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ConsoleResetPassword $action)
    {
        if ($this->option('all')) {
            $result = $action->resetAllPassword();
        } else if($this->option('cedula')) {
            $result = $action->resetUserPassword($this->option('cedula'));
        } else if($this->option('cedula')) {
            $result = $action->resetUsersPassword($this->option('cedula'));
        }

        if (isset($result)) {
            $this->info('Comando ejecutado satisfactoriamente');

            return Command::SUCCESS;
        } else {
            $this->error('Error al ejecutar el comando');

            return Command::FAILURE;
        }

    }
}
