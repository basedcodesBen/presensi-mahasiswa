@extends('layouts.master')

@section('title', 'Create mahasiswa')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Mahasiswa</h4>
                    <p>Edit data Mahasiswa disini</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NRP Mahasiswa</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Enter Kode mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama mahasiswa</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                        <label for="program_studi_id">Program Studi</label>
                        <select name="program_studi_id" id="program_studi_id" class="form-control" required>
                            @foreach($programStudis as $programStudi)
                                <option value="{{ $programStudi->id }}">
                                    {{ $programStudi->program_studi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
