@extends('layouts.master')

@section('title', 'Detail Pertemuan')

@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5>Detail Pertemuan</h5>
            <p class="mb-0">
                Matakuliah: {{ $matakuliah->nama_matakuliah }} ({{ $matakuliah->kode_matakuliah }})
            </p>
            <p class="mb-0">Pertemuan: {{ $dhmd->pertemuan }} | Tanggal: {{ $dhmd->tanggal }}</p>
        </div>
        <div class="card-body">

            <!-- Back Button -->
            <a href="{{ route('dosen.matakuliah.detail', $matakuliah->id) }}" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <!-- Table: Existing Users -->
            @if($existingUsers->isNotEmpty())
                <h5>Daftar Kehadiran</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($existingUsers as $detail)
                        <tr>
                            <td class="text-center">{{ $detail->userNik->nama }}</td>
                            <td class="text-center">{{ $detail->userNik->nik }}</td>
                            <td class="text-center">{{ $detail->status }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $detail->userNik->nik }}">
                                    Show Photo
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-{{ $detail->userNik->nik }}" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="photoModalLabel">Student Photo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <!-- Replace this with the photo you want to display -->
                                        <img src="{{ asset($detail->Image) }}" alt="Foto Mahasiswa" style="max-height: 300px;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Tidak ada data kehadiran untuk pertemuan ini.</p>
            @endif

            <!-- Table: Missing Users -->
            @if($missingUsers->isNotEmpty())
                <h5>Daftar Mahasiswa Yang Tidak Hadir</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="text-center">NIM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($missingUsers as $dkbsUser)
                        <tr>
                            <td class="text-center">{{ $dkbsUser->mahasiswa->nama }}</td>
                            <td class="text-center">{{ $dkbsUser->mahasiswa->nik }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


        </div>
    </div>
</div>
@endsection
