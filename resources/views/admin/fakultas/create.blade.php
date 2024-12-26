@extends('layouts.master')

@section('title', 'Create Fakultas')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Fakultas</h4>
                    <p>Tambah data Fakultas disini</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.fakultas.store') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Fakultas</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama Fakultas" required>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
