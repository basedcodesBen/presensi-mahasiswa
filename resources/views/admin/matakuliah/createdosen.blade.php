@extends('layouts.master')

@section('title', 'Create Mata Kuliah')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Mata Kuliah</h4>
                    <p>Tambah data Dosen disini</p>
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
                    <form action="{{ route('admin.matakuliah.storeDosen', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id, 'matkul' => $mk->id]) }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.matakuliah.matkuldetail', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id, 'matkul' => $mk->id]) }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        <h4 class="m-3">{{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }}</h4>
                        <label for="dosen">Dosen</label>
                        <select name="dosen" id="dosen" class="form-control" required>
                            @forelse($dosen as $d)
                                <option value="{{ $d->nik }}">
                                    {{ $d->nik }} - {{ $d->nama }}
                                </option>
                            @empty
                                <option value="">Tidak Ada Dosen Aktif</option>
                            @endforelse
                        </select>
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            @foreach(range('A', 'D') as $kelas)
                                <option value="{{ $kelas }}">{{ $kelas }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
