@extends('layout.app')

@section('content')
    <div class="list-container">
        <a href="/teacher/create" class="add">Tambah Data</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Matematika</th>
                    <th>B. Indonesia</th>
                    <th>B. Inggris</th>
                    <th>Kejuruan</th>
                    <th>Rata-rata</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="data-table">
                @foreach ($nilais as $index => $nilai)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $nilai->siswa->nis ?? 'N/A' }}</td>
                    <td>{{ $nilai->siswa->nama_siswa ?? 'N/A' }}</td>
                    <td>{{ $nilai->matematika }}</td>
                    <td>{{ $nilai->indonesia }}</td>
                    <td>{{ $nilai->inggris }}</td>
                    <td>{{ $nilai->kejuruan }}</td>
                    <td>{{ $nilai->rata_rata }}</td>
                    <td>
                        <a href="/teacher/view/{{ $nilai->siswa_id }}" class="view">View</a>
                        <a href="/teacher/edit/{{ $nilai->id }}" class="edit">Edit</a>
                        <form action="/teacher/destroy/{{ $nilai->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah anda ingin menghapus data ini?')" class="delete">Delete</button> 
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection