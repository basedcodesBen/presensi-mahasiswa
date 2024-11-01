@extends('layouts.master')

@section('title', 'Create Dosen')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Dosen</h4>
                    <p>Edit data dosen disini</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.dosen.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nik" class="form-label">Kode Dosen</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Enter Kode Dosen" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama Dosen" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
