<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

final class BancoSocioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = Reader::createFromString(Storage::disk('local')->get('migraciones/bancos_socios.csv'));
        $reader->setHeaderOffset(0);

        $header = $reader->getHeader();
        $records = $reader->getRecords();

        $data = [];

        foreach ($records as $record) {
            foreach ($record as $key => $r) {
                $record[$key] = $r == '' ? null : $record[$key];
            }
            $data[] = array_combine($header, $record);
        }

        DB::connection('sca')->table('bancos_socios')->insert($data);
    }
}
