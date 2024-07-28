<?php

namespace App\Repositories\SCA;

use Illuminate\Support\Facades\DB;

final readonly class TasaDolarRepository {

    public function getPaginaReferencia() : string {
        return DB::connection('sca')->table('configuraciones')->where('clave', 'like', 'Referencia Dolar')->value('valor');
    }

    public function getMonedaPrincipalId() : int {
        $isoCode = DB::connection('sca')->table('configuraciones')->where('clave', 'like', 'ISO-4217 Moneda Principal')->value('valor');
        return DB::connection('sca')->table('monedas')->where('iso_4217', 'like', $isoCode)->value('id');
    }

    public function getMonedaSecundariaId() : int {
        $isoCode = DB::connection('sca')->table('configuraciones')->where('clave', 'like', 'ISO-4217 Moneda Secundaria')->value('valor');
        return DB::connection('sca')->table('monedas')->where('iso_4217', 'like', $isoCode)->value('id');
    }

    public function getXPATHReferencia() : string {
        return DB::connection('sca')->table('configuraciones')->where('clave', 'like', 'XPATH Referencia Dolar')->value('valor');
    }

}
