<?php

namespace Database\Seeders;

use App\Classes\Enums\StatusPassword;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Csv\Reader;

final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = Reader::createFromString(Storage::disk('local')->get('migraciones/users.csv'));
        $reader->setHeaderOffset(0);

        $header = $reader->getHeader();
        $records = $reader->getRecords();

        DB::connection(name: 'seguridad')->table(table: 'users')->insert(values: [
            ['cedula' => 'root', 'tipo' => 'ROOT', 'status_password' => StatusPassword::VALIDO->value, 'uuid' => Str::uuid()->toString(), 'password' => Hash::make(value: 'rootSCA2023*'), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['cedula' => 'admincauneg', 'tipo' => 'ADMINISTRADOR', 'status_password' => StatusPassword::VALIDO->value, 'uuid' => Str::uuid()->toString(), 'password' => Hash::make(value: 'administradorSCA2023*'), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $data = [];
        $cedulas = [];

        foreach ($records as $record) {
            if (in_array($record['cedula'], $cedulas)) {
                continue;
            }
            foreach ($record as $key => $r) {
                $record[$key] = $r == '' ? null : $record[$key];
            }
            $cedulas[] = $record['cedula'];
            $data[] = array_combine($header, $record);
        }

        DB::connection(name: 'seguridad')->table(table: 'users')->insert($data);
    }
}
