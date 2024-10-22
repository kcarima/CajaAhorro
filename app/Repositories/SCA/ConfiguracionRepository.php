<?php

namespace App\Repositories\SCA;

use App\Models\SCA\Configuracion;

final readonly class ConfiguracionRepository {

    public function get(string $key) {
        return Configuracion::where('clave', 'like', $key)->value('valor');
    }

}
