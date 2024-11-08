<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create(['nama_Kelas' => '12 RPL 1']);
        Kelas::create(['nama_kelas' => '12 RPL 2']);
    }
}
