@extends('layouts.dosen.master')

@section('title', 'Attendance Details')

@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5>Attendance Details</h5>
            <p class="mb-0">Show this QR code to your students for attendance.</p>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p><strong>Lecturer Name:</strong> {{ auth()->user()->nama }}</p>
                <p><strong>Lecturer ID (NIK):</strong> {{ auth()->user()->nik }}</p>
                <p><strong>Course:</strong> {{ $kehadiran->mataKuliah->nama_matakuliah }} ({{ $kehadiran->id_matakuliah }})</p>
                <p><strong>Date and Time:</strong> {{ \Carbon\Carbon::parse($kehadiran->tanggal)->format('d-m-Y H:i') }}</p>
                <p><strong>Meeting Number:</strong> {{ $kehadiran->pertemuan }}</p>
            </div>
            <div class="text-center">
                <img src="{{ asset($kehadiran->qr_code) }}" alt="QR Code" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection
