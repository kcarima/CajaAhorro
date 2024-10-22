<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

final class HistoricoFichaSocioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = Reader::createFromString(Storage::disk('local')->get('migraciones/historico_fichas_socios.csv'));
        $reader->setHeaderOffset(0);

        $header = $reader->getHeader();
        $records = $reader->getRecords();

        $id_moneda = DB::connection(name: 'sca')->table(table: 'monedas')->where('es_default', true)->value('id');

        $data = [];

        foreach ($records as $record) {
            $record['moneda_id'] = $id_moneda;
            foreach ($record as $key => $r) {
                $record[$key] = $r == '' ? null : $record[$key];
            }
            $data[] = array_combine($header, $record);
        }

        DB::connection(name: 'sca')->table(table: 'historico_fichas_socios')->insert($data);
    }
}
