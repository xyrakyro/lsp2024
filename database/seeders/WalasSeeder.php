<?php

namespace Database\Seeders;

use App\Models\Walas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nig' => '99001111',
                'nama_walas' => 'Rudi Setiawan',
                'kelas_id' => 1,
                'password' => bcrypt('1234'),
            ],
            [
                'nig' => '99001122',
                'nama_walas' => 'Tari Melani',
                'kelas_id' => 2,
                'password' => bcrypt('1234')
            ],
        ];

        foreach ($data as $walas) {
            Walas::create($walas);
        }
    }
}
