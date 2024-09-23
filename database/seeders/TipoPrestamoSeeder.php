<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

final class TipoPrestamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = Reader::createFromString(Storage::disk('local')->get('migraciones/tipos_prestamos.csv'));
        $reader->setHeaderOffset(0);

        $header = $reader->getHeader();
        $records = $reader->getRecords();

        $data = [];

        foreach ($records as $record) {
            $data[] = array_combine($header, $record);
        }

        DB::connection('sca')->table('tipos_prestamos')->insert($data);
    }
}
