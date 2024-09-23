<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

final class SocioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = Reader::createFromString(Storage::disk('local')->get('migraciones/socios.csv'));
        $reader->setHeaderOffset(0);

        $header = $reader->getHeader();
        $records = $reader->getRecords();

        $id_moneda = DB::connection(name: 'sca')->table(table: 'monedas')->where('es_default', true)->value('id');

        DB::connection(name: 'sca')->table(table: 'socios')->insert(values: [
            [
                'nombre' => 'ROOT',
                'ficha' => 'root',
                'cedula' => 'root',
                'fecha_ingreso_uneg' => '1982-03-09',
                'fecha_ingreso_cauneg' => '1982-03-09',
                'moneda_id' => $id_moneda,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'ADMINISTRADOR',
                'ficha' => 'admincauneg',
                'cedula' => 'admincauneg',
                'fecha_ingreso_uneg' => '1970-01-01',
                'fecha_ingreso_cauneg' => '1970-01-01',
                'moneda_id' => $id_moneda,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $data = [];
        $cedulas = [];

        foreach ($records as $record) {
            if (in_array($record['cedula'], $cedulas)) {
                continue;
            }
            $record['moneda_id'] = $id_moneda;
            foreach ($record as $key => $r) {
                $record[$key] = $r == '' ? null : $record[$key];
            }
            $data[] = array_combine($header, $record);
            $cedulas[] = $record['cedula'];
        }

        DB::connection(name: 'sca')->table(table: 'socios')->insert($data);
    }
}
