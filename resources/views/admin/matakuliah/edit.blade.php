@extends('layouts.master')

@section('title', 'Edit Data Mata Kuliah')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="m-0">Edit Data Mata Kuliah</h4>
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
                <form action="{{ route('admin.matakuliah.update', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id, 'matkul' => $matkul->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kode">Kode Mata Kuliah</label>
                        <input type="text" name="kode" id="kode" class="form-control" value="{{ $matkul->kode_matakuliah }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama">Nama Mata Kuliah</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $matkul->nama_matakuliah }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sks">SKS</label>
                        <input type="number" name="sks" id="sks" min="1" max="4" class="form-control" value="{{ $matkul->sks }}" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('admin.matakuliah.prodidetail', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id]) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
