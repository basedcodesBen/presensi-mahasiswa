@extends('layouts.master')

@section('title', 'Create Attendance')

@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5>Create Attendance</h5>
            <p class="mb-0">Generate a QR code for student attendance.</p>
        </div>
        <div class="card-body">
            <form action="{{ route('kehadiran.mahasiswa.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="id_matakuliah" class="form-label">Course</label>
                    <select name="id" id="id_matakuliah" class="form-select">
                        @foreach($courses as $course)
                            <option value="{{ $course->mataKuliah->id }}">{{ $course->mataKuliah->nama_matakuliah }} ({{ $course->id_matakuliah }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Date and Time</label>
                    <input type="datetime-local" name="tanggal" id="tanggal" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="pertemuan" class="form-label">Meeting Number</label>
                    <input type="number" name="pertemuan" id="pertemuan" class="form-control" min="1">
                </div>
                <button type="submit" class="btn btn-primary">Generate QR Code</button>
            </form>
        </div>
    </div>
</div>
@endsection
