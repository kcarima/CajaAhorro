<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

final class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = Reader::createFromString(Storage::disk('local')->get('migraciones/cargos.csv'));
        $reader->setHeaderOffset(0);

        $header = $reader->getHeader();
        $records = $reader->getRecords();

        $data = [];

        foreach ($records as $record) {
            $data[] = array_combine($header, $record);
        }

        DB::connection('uneg')->table('cargos')->insert($data);
    }
}
