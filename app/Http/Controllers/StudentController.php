<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function grade($nilai){
        if ($nilai >= 90) {
            return 'A';
        } elseif ($nilai >= 80) {
            return 'B';
        } elseif ($nilai >= 70) {
            return 'C';
        } elseif ($nilai >= 60) {
            return 'D';
        } else {
            return 'E';
        }
    }

    public function index(){
        $siswa = Siswa::with('kelas', 'nilai')->find(session('id'));

        $nilai = optional($siswa->nilai)->first();

        $walas = Nilai::with('walas')->first();

        $data_nilai = [
            'matematika' => [
                'nilai' => $nilai->matematika ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->grade($nilai->matematika) : 'N/A'
            ],
            'indonesia' => [
                'nilai' => $nilai->indonesia ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->grade($nilai->indonesia) : 'N/A'
            ],
            'inggris' => [
                'nilai' => $nilai->inggris ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->grade($nilai->inggris) : 'N/A'
            ],
            'kejuruan' => [
                'nilai' => $nilai->kejuruan ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->grade($nilai->kejuruan) : 'N/A'
            ],
            'pilihan' => [
                'nilai' => $nilai->pilihan ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->grade($nilai->pilihan) : 'N/A'
            ],
            'rata_rata' => [
                'nilai' => $nilai->rata_rata ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->grade($nilai->rata_rata) : 'N/A'
            ]
        ];
        return view('student.index', [
            'siswa' => $siswa,
            'data_nilai' => $data_nilai,
            'walas' => $walas
        ]);
    }
}
