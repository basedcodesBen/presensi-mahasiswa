@extends('layout.master')

@section('tittle','dosen')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Data Matakuliah</h5>
            <p class="mb-0">A lightweight, extendable, dependency-free JavaScript HTML table plugin.</p>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label>Entries per page</label>
                <select class="form-select d-inline w-auto" id="entriesPerPage">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NAMA MATAKULIAH</th>
                        <th>KODE MATAKULIAH</th>
                        <th>KELAS</th>
                        <th>Pertemuan</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matakuliah as $mk)
                    <tr>
                        <td>{{ $mk->nama_matakuliah }}</td>
                        <td>{{ $mk->kode_matakuliah }}</td>
                        <td>{{ $mk->kelas }}</td>
                        <td>{{ $mk->pertemuan }}</td>
                        <td>{{ $mk->jumlah_mahasiswa }}</td>
                        <td><a href="{{ route('matakuliah.show', $mk->id) }}" class="btn btn-link">View Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $matakuliah->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
