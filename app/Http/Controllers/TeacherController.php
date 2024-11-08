<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //
    public function index(){
        $nilais = Nilai::with('siswa')
            ->where('walas_id', session('id'))->get();

        return view('teacher.index', compact('nilais'));
    }

    public function create(){
        $siswas = Siswa::where('kelas_id', session('id'))->get();

        return view('teacher.create', compact('siswas'));
    }

    public function store(Request $request){
        $walasId = session('id');

        if (!$walasId) {
            return redirect('/teacher')->withErrors(['walas_id' => 'ID Walas tidak ditemukan']);
        }

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'matematika' => 'required|numeric',
            'indonesia' => 'required|numeric',
            'inggris' => 'required|numeric',
            'kejuruan' => 'required|numeric',
            'pilihan' => 'required|numeric',
        ]);

        $nilai = Nilai::where('siswa_id', $request->siswa_id)->first();

        if ($nilai) {
            return redirect('/teacher/create')->withErrors(['siswa_id' => 'Nilai untuk siswa ini sudah ada']);
        }

        $rata_rata = round(($request->matematika + $request->indonesia + $request->inggris + $request->kejuruan + $request->pilihan) / 5, 2);

        Nilai::create([
            'walas_id' => $walasId,
            'siswa_id' => $request->siswa_id,
            'matematika' => $request->matematika,
            'indonesia' => $request->indonesia,
            'inggris' => $request->inggris,
            'kejuruan' => $request->kejuruan,
            'pilihan' => $request->pilihan,
            'rata_rata' => $rata_rata
        ]);

        return redirect('/teacher')->with('success', 'Nilai berhasil disimpan.');
    }

    public function edit($id){
        $nilai = Nilai::with('walas')->find($id);
        $siswas = Siswa::where('kelas_id', session('id'))->get();

        return view('teacher.edit', compact('nilai', 'siswas'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'matematika' => 'required|numeric',
            'indonesia' => 'required|numeric',
            'inggris' => 'required|numeric',
            'kejuruan' => 'required|numeric',
            'pilihan' => 'required|numeric',
        ]);

        $rata_rata = round(($request->matematika + $request->indonesia + $request->inggris + $request->kejuruan + $request->pilihan) / 5, 2);

        $nilai = Nilai::findOrFail($id);

        $nilai->update([
            'siswa_id' => $request->siswa_id,
            'matematika' => $request->matematika,
            'indonesia' => $request->indonesia,
            'inggris' => $request->inggris,
            'kejuruan' => $request->kejuruan,
            'pilihan' => $request->pilihan,
            'rata_rata' => $rata_rata
        ]);

        return redirect('/teacher')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id){
        $nilai = Nilai::find($id);
        $nilai->delete();
        return back();
    }

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

    public function show($id){
        $nilai = Nilai::with('siswa')->where('siswa_id', $id)->first();

        if ($nilai === null) {
            return back()->withErrors('Nilai untuk siswa ini tidak ditemukan');
        }

        $siswa = Siswa::with('nilai', 'kelas')->find($nilai->siswa_id);

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
