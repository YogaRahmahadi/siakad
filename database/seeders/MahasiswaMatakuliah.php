<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMatakuliah extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa_matakuliah = [
            ['id_mahasiswa' => 1, 'matakuliah_id' => 1, 'nilai' => 'A'],
            ['id_mahasiswa' => 1, 'matakuliah_id' => 2, 'nilai' => 'A'],
            ['id_mahasiswa' => 1, 'matakuliah_id' => 3, 'nilai' => 'A'],
            ['id_mahasiswa' => 1, 'matakuliah_id' => 4, 'nilai' => 'A'],

            ['id_mahasiswa' => 2, 'matakuliah_id' => 1, 'nilai' => 'A'],
            ['id_mahasiswa' => 2, 'matakuliah_id' => 2, 'nilai' => 'B'],
            ['id_mahasiswa' => 2, 'matakuliah_id' => 3, 'nilai' => 'A'],
            ['id_mahasiswa' => 2, 'matakuliah_id' => 4, 'nilai' => 'B'],

            ['id_mahasiswa' => 3, 'matakuliah_id' => 1, 'nilai' => 'B'],
            ['id_mahasiswa' => 3, 'matakuliah_id' => 2, 'nilai' => 'B'],
            ['id_mahasiswa' => 3, 'matakuliah_id' => 3, 'nilai' => 'A'],
            ['id_mahasiswa' => 3, 'matakuliah_id' => 4, 'nilai' => 'A'],

            ['id_mahasiswa' => 4, 'matakuliah_id' => 1, 'nilai' => 'B'],
            ['id_mahasiswa' => 4, 'matakuliah_id' => 2, 'nilai' => 'C'],
            ['id_mahasiswa' => 4, 'matakuliah_id' => 3, 'nilai' => 'A'],
            ['id_mahasiswa' => 4, 'matakuliah_id' => 4, 'nilai' => 'A'],  
        ];

        DB::table('mahasiswa_matakuliah')->insert($mahasiswa_matakuliah);
    }
}
