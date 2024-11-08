@extends('layout.app')

@section('content')
    <div class="create-container">
        <form action="{{ route('teacher.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="walas">Walas:</label>
                <input type="text" class="form-control" id="walas" name="walas" value="{{ session('username') }}" disabled>
            </div>

            <div class="form-group">
                <label for="siswa_id">Nama Siswa:</label>
                <select name="siswa_id" id="siswa_id" class="form-control" required>
                    @foreach ($siswas as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="matematika">Matematika:</label>
                <input type="number" class="form-control" id="matematika" name="matematika" required>
            </div>
            <div class="form-group">
                <label for="indonesia">Bahasa Indonesia:</label>
                <input type="number" class="form-control" id="indonesia" name="indonesia" required>
            </div>
            <div class="form-group">
                <label for="inggris">Bahasa Inggris:</label>
                <input type="number" class="form-control" id="inggris" name="inggris" required>
            </div>
            <div class="form-group">
                <label for="kejuruan">Kejuruan:</label>
                <input type="number" class="form-control" id="kejuruan" name="kejuruan" required>
            </div>
            <div class="form-group">
                <label for="pilihan">Mapel Pilihan:</label>
                <input type="number" class="form-control" id="pilihan" name="pilihan" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection