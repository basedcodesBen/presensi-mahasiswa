@extends('layouts.master')

@section('title', 'Create Mata Kuliah')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Mata Kuliah</h4>
                    <p>Tambah data Mata Kuliah {{ $programStudi->program_studi }} disini</p>
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            @foreach($errors->all() as $error)
                                    <li class="text-light font-weight-bold">{{ $error }}</li>
                                @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none;">
                                <i class="ni ni-fat-remove opacity-100" style="font-size: 1.25rem;"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.matakuliah.store', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id]) }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.matakuliah.prodidetail', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id]) }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Enter Kode Mata Kuliah" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama Mata Kuliah" required>
                        </div>
                        <input type="hidden" class="form-control" id="prodi" name="prodi" value="{{ $programStudi->id }}">
                        <div class="mb-3">
                            <label for="sks" class="form-label">SKS Mata Kuliah</label>
                            <input type="number" class="form-control" id="sks" name="sks" min="1" max="4" placeholder="Jumlah SKS Mata Kuliah" required>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
