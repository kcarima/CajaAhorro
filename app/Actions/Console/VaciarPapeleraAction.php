<?php

namespace App\Actions\Console;

use App\Models\SCA\Moneda;
use Carbon\Carbon;

final class VaciarPapeleraAction {

    public function handle() {

        $modelos = [
            Moneda::class
        ];

        foreach($modelos as $modelo) {
            $fechaLimite = Carbon::now()->subDays(30);

            $modelo::where('deleted_at', '<', $fechaLimite)->forceDelete();
        }

    }

}
