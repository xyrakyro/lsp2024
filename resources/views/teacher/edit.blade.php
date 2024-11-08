@extends('layout.app')

@section('content')
    <div class="create-container">
        <form action="/teacher/update/{{ $nilai->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="walas">Walas:</label>
                <input type="text" class="form-control" id="walas" name="walas" value="{{ $nilai->walas->nama_walas }}" disabled>
            </div>

            <div class="form-group">
                <label for="siswa_id">Nama Siswa:</label>
                <select name="siswa_id" id="siswa_id" class="form-control" required>
                    @foreach ($siswas as $siswa)
                        <option value="{{ $siswa->id }}" {{ $siswa->id == $nilai->siswa_id ? 'selected' : '' }}>
                            {{ $siswa->nama_siswa }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="matematika">Matematika:</label>
                <input type="number" class="form-control" id="matematika" name="matematika" value="{{ $nilai->matematika }}" required>
            </div>
            <div class="form-group">
                <label for="indonesia">Bahasa Indonesia:</label>
                <input type="number" class="form-control" id="indonesia" name="indonesia" value="{{ $nilai->indonesia }}" required>
            </div>
            <div class="form-group">
                <label for="inggris">Bahasa Inggris:</label>
                <input type="number" class="form-control" id="inggris" name="inggris" value="{{ $nilai->inggris }}" required>
            </div>
            <div class="form-group">
                <label for="kejuruan">Kejuruan:</label>
                <input type="number" class="form-control" id="kejuruan" name="kejuruan" value="{{ $nilai->kejuruan }}" required>
            </div>
            <div class="form-group">
                <label for="pilihan">Mapel Pilihan:</label>
                <input type="number" class="form-control" id="pilihan" name="pilihan" value="{{ $nilai->pilihan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection