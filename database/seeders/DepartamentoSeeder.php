<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Csv\Reader;

final class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = Reader::createFromString(Storage::disk('local')->get('migraciones/departamentos.csv'));
        $reader->setHeaderOffset(0);

        $header = $reader->getHeader();
        $records = $reader->getRecords();

        $data = [];

        foreach ($records as $record) {
            $data[] = array_combine($header, $record);
        }

        DB::connection('uneg')->table('departamentos')->insert($data);

        DB::connection(name: 'uneg')->table(table: 'departamentos')->insert(values: [
            ['codigo' => '330002', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '240', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '330001', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '101000', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
