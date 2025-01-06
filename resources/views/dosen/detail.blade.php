@extends('layouts.master')

@section('title', 'Detail Matakuliah')

@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5>Detail Matakuliah</h5>
            <p class="mb-0">{{ $matakuliah->nama_matakuliah }} ({{ $matakuliah->kode_matakuliah }})</p>
        </div>
        <div class="card-body">

            <!-- Back Button -->
            <a href="{{ route('dosen.matakuliah') }}" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            @if($matakuliah->kehadiran->isNotEmpty())
                <h5>Daftar Pertemuan</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Pertemuan</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matakuliah->kehadiran as $kehadiran)
                        <tr>
                            <td class="text-center">Pertemuan {{ $kehadiran->pertemuan }}</td>
                            <td class="text-center">{{ $kehadiran->tanggal }}</td>
                            <td class="text-center">
                                <a href="{{ route('dosen.matakuliah.pertemuan', [$matakuliah->id, $kehadiran->idpresensi]) }}" class="btn btn-link">Lihat Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Tidak ada pertemuan untuk matakuliah ini.</p>
            @endif

        </div>
    </div>
</div>
@endsection
