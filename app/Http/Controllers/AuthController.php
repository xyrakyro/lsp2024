<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Walas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request, Siswa $siswa, Walas $walas){
        $request->validate([
            'user_type' => 'required|string|in:student,teacher',
        ]);

        if ($request->user_type == 'student') {
            $request->validate([
                'nis' => 'required|string',
                'student_password' => 'required|string',
            ]);
            return $this->authenticateStudent($request, $siswa);
        } else {
            $request->validate([
                'nig' => 'required|string',
                'teacher_password' => 'required|string',
            ]);
            return $this->authenticateTeacher($request, $walas);
        }
    }
    private function authenticateStudent(Request $request, Siswa $siswa){
        $students = $siswa::all();
        foreach ($students as $student) {
            if ($student->nis === $request->nis && Hash::check($request->student_password, $student->password)) {
                session(['user_type' => 'student', 'id' => $student->id, 'username' => $student->nama_siswa]);
                return redirect()->intended('/student');
            }
        }

        return redirect()->back()->withInput()->withErrors([
            'message' => 'nis atau password siswa salah',
        ]);
    }

    private function authenticateTeacher(Request $request, Walas $walas){
        $teachers = $walas::all();
        foreach ($teachers as $teacher) {
            if ($teacher->nig === $request->nig && Hash::check($request->teacher_password, $teacher->password)) {
                session(['user_type' => 'teacher', 'id' => $teacher->id, 'username' => $teacher->nama_guru]);
                return redirect()->intended('/teacher');
            }
        }

        return redirect()->back()->withInput()->withErrors([
           'message' => 'nig atau password guru salah',
        ]);
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login')->with('message', 'Anda telah logout');
    }

}
