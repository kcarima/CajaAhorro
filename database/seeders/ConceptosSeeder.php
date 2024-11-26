<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class ConceptosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection(name: 'sca')->table(table: 'conceptos')->insert(values: [
            ['codigo' => '018', 'descripcion' => 'AHORRO -APORTE UNEG','accion' => '+', 'status' => 1],
            ['codigo' => '115', 'descripcion' => 'AHORRO JUBILADOS  APORTE','accion' => '+', 'status' => 1],
            ['codigo' => '541', 'descripcion' => 'AHORRO JUBILAD.-RET.EMPL','accion' => '+', 'status' => 1],
            ['codigo' => '516', 'descripcion' => 'PRESTAMO CAUNEG','accion' => '+', 'status' => 1],
            ['codigo' => '521', 'descripcion' => 'PRESTAMO CAUNEG II','accion' => '+', 'status' => 1],
            ['codigo' => '502', 'descripcion' => 'AHORRO - RETENC. EMPLEADO','accion' => '+', 'status' => 1],
            ['codigo' => '525', 'descripcion' => 'PRESTAMO HIPOTECARIO','accion' => '+', 'status' => 1],
            ['codigo' => '116', 'descripcion' => 'AHORRO PENS. APORTE','accion' => '+', 'status' => 1],
            ['codigo' => '542', 'descripcion' => 'AHORRO PENSIO.RET.EMPLEA','accion' => '+', 'status' => 1],
            ['codigo' => '533', 'descripcion' => 'PRESTAMO CAUNEG III','accion' => '+', 'status' => 1],
            ['codigo' => '660', 'descripcion' => 'PRESTA.CAUNEG VEHICULO','accion' => '+', 'status' => 1],
            ['codigo' => '517', 'descripcion' => 'RETROACT.CAJA AHORRO-RET','accion' => '+', 'status' => 1],
            ['codigo' => '240', 'descripcion' => 'AHORRO-APORTE UNEG','accion' => '+', 'status' => 1],
            ['codigo' => '637', 'descripcion' => 'AHORRO RETENCION EMPLEADO','accion' => '+', 'status' => 1],
            ['codigo' => '577', 'descripcion' => 'CASAS COMERCIALES CAUNEG','accion' => '+', 'status' => 1],
            ['codigo' => '029', 'descripcion' => 'APORTE.AHORRO CAUNEG.JUB.','accion' => '+', 'status' => 1],
            ['codigo' => '559', 'descripcion' => 'AHORRO - RETENC. JUB.','accion' => '+', 'status' => 1],
            ['codigo' => '109', 'descripcion' => 'APORTE.AHORRO CAUNEG.PENS.','accion' => '+', 'status' => 1],
            ['codigo' => '602', 'descripcion' => 'AHORRO - RETENC. PENS.','accion' => '+', 'status' => 1],
            ['codigo' => '524', 'descripcion' => 'PRESTAMO CAUNEG III','accion' => '+', 'status' => 1],
            ['codigo' => '515', 'descripcion' => 'PRESTAMO CAUNEG II','accion' => '+', 'status' => 1],
            ['codigo' => '2115', 'descripcion' => 'AHORRO-JUB-APORTE','accion' => '+', 'status' => 1],
            ['codigo' => '4541', 'descripcion' => 'AHORRO-RTENC-JUB','accion' => '+', 'status' => 1],
            ['codigo' => '4502', 'descripcion' => 'RETENCIÓN-EMP-CAUNEG','accion' => '+', 'status' => 1],
            ['codigo' => '6338', 'descripcion' => 'PRESTAMO CAUNEG III','accion' => '+', 'status' => 1],
            ['codigo' => '6522', 'descripcion' => 'PRESTAMO AHORRO - CAUNEG','accion' => '+', 'status' => 1],
            ['codigo' => '6533', 'descripcion' => 'PRESTAMO CAUNEG III','accion' => '+', 'status' => 1],
            ['codigo' => '6517', 'descripcion' => 'PLAN CORPORATIVO-ADMON','accion' => '+', 'status' => 1],
            ['codigo' => '2116', 'descripcion' => 'AHORRO-PENS-APORTE','accion' => '+', 'status' => 1],
            ['codigo' => '4542', 'descripcion' => 'AHORRO-RETC-PENS','accion' => '+', 'status' => 1],
            ['codigo' => '6224', 'descripcion' => 'CUOTA PRESTAMO AHORRO','accion' => '+', 'status' => 1],
            ['codigo' => '6525', 'descripcion' => 'PRESTAMO HIPOTECARIO','accion' => '+', 'status' => 1],
            ['codigo' => '2024', 'descripcion' => 'RETROACT-CAJA AHORR-APORT','accion' => '+', 'status' => 1],
            ['codigo' => '4551', 'descripcion' => 'RETROACT-CAJA AHORR-RETC','accion' => '+', 'status' => 1],
            ['codigo' => '2238', 'descripcion' => 'RETROACT-  APORT CAUNEG-JUB','accion' => '+', 'status' => 1],
            ['codigo' => '4642', 'descripcion' => 'RETROAT- RETC- AHORR- JUB','accion' => '+', 'status' => 1],
            ['codigo' => '6660', 'descripcion' => 'PRESTAMO CAUNEG VEHICULO','accion' => '+', 'status' => 1],
            ['codigo' => '900', 'descripcion' => 'CAPITALIZACION DIVIDENDOS','accion' => '+', 'status' => 1],
            ['codigo' => '2331', 'descripcion' => 'DEDUCCION AHORRO APORTE JUB','accion' => '+', 'status' => 1],
            ['codigo' => '4332', 'descripcion' => 'DEDUCCION AHORRO RETENCIÓN JUB','accion' => '+', 'status' => 1],
            ['codigo' => '2818', 'descripcion' => 'DIFERENCIA APORT CAJA AHORRO','accion' => '+', 'status' => 1],
            ['codigo' => '4112', 'descripcion' => 'DIFERENCIA CAJA AHORRO-RETC-EMP','accion' => '+', 'status' => 1],
            ['codigo' => '6583', 'descripcion' => 'MONTEPIO CAUNEG','accion' => '+', 'status' => 1],
            ['codigo' => '6214', 'descripcion' => 'CUOTA PRESTAMO AHORRO DOBLE','accion' => '+', 'status' => 1],
            ['codigo' => '6461', 'descripcion' => 'PRESTAMO 1 CAJA DE AHORRO','accion' => '+', 'status' => 1],
            ['codigo' => '6577', 'descripcion' => 'CASAS COMERCIALES CAUNEG ( BONO)','accion' => '+', 'status' => 1],
            ['codigo' => '6300', 'descripcion' => 'SEGUNDO PRESTAMO AHORRO VACACION','accion' => '+', 'status' => 1],
            ['codigo' => '9011', 'descripcion' => 'APORT. DIFERENCIA PRIMA DE ANTIGUEDAD','accion' => '+', 'status' => 1],
            ['codigo' => '9012', 'descripcion' => 'RETC.  DIFERENCIA PRIMA DE ANTIGUEDAD','accion' => '+', 'status' => 1],
            ['codigo' => '6348', 'descripcion' => 'CUOTA TERCER PRESTAMO VACACION','accion' => '+', 'status' => 1],
            ['codigo' => '6521', 'descripcion' => 'PRESTAMO CAUNEG 2','accion' => '+', 'status' => 1],
            ['codigo' => '6650', 'descripcion' => 'DESCUENTO ESPECIAL CAUNEG ( BONO)','accion' => '+', 'status' => 1],
            ['codigo' => '6000', 'descripcion' => 'PRESTAMO ESPECIAL CAUNEG','accion' => '+', 'status' => 1],
            ['codigo' => '4000', 'descripcion' => 'PRESTAMO ESPECIAL CAUNEG','accion' => '+', 'status' => 1],
            ['codigo' => '2477', 'descripcion' => 'APORTE CAJA DE AHORRO','accion' => '+', 'status' => 1],
            ['codigo' => '2018', 'descripcion' => 'APORTE CAJA DE AHORRO CAUNEG','accion' => '+', 'status' => 1],
            ['codigo' => '6007', 'descripcion' => 'DESCUENTO DE RUBROS DE ALIMENTOS','accion' => '+', 'status' => 1],
            ['codigo' => '4517', 'descripcion' => 'RETROACTIVO CAJA DE AHORRO / RETENCIÒN','accion' => '+', 'status' => 1],
            ['codigo' => '6516', 'descripcion' => 'PRESTAMO CAUNEG ','accion' => '+', 'status' => 1],
            ['codigo' => '2117', 'descripcion' => 'APORTE CAUNEG PENDIENTE JUBILADO','accion' => '+', 'status' => 1],
            ['codigo' => '2118', 'descripcion' => 'APORTE CAUNEG PENDIENTE PENSIONADO','accion' => '+', 'status' => 1],
            ['codigo' => '4380', 'descripcion' => 'RETRO RETENCIÒN AHORRO PENSIÒN','accion' => '+', 'status' => 1],
        ]);
    }
}