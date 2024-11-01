@extends('layouts.dosen.master')

@section('title', 'Dosen')

@section('content')
<div class="col-lg-12"">
    <div class="card shadow-sm ">
        <div class="card-header bg-white">
            <h5>Data Matakuliah</h5>
            <p class="mb-0">A lightweight, extendable, dependency-free JavaScript HTML table plugin.</p>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label>Entries per page</label>
                <select class="form-select d-inline" style="width: 50px" id="entriesPerPage">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            @if($matakuliah->isNotEmpty())
                <!-- Show table only if there is data -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">NAMA MATAKULIAH</th>
                            <th class="text-center">KODE MATAKULIAH</th>
                            <th class="text-center">KELAS</th>
                            <th class="text-center">Pertemuan</th>
                            <th class="text-center">Jumlah Mahasiswa</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matakuliah as $mk)
                        <tr>
                            <td class="text-center">{{ $mk->nama_matakuliah }}</td>
                            <td class="text-center">{{ $mk->id_matakuliah }}</td>
                            <td class="text-center">{{ $mk->kelas }}</td>
                            <td class="text-center">{{ $mk->pertemuan }}</td>
                            <td class="text-center">{{ $mk->jumlah_mahasiswa }}</td>
                            <td class="text-center"><a href="#" class="btn btn-link">View Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


            <div class="d-flex mt-4">
                {{ $matakuliah->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
