@extends('layouts.master')

@section('title', 'Edit Data Mata Kuliah')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="m-0">Edit Data Kelas</h4>
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
                <form action="{{ route('admin.matakuliah.updatekelas', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id, 'matkul' => $matkul->id, 'kelas' => $kelas->id ]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="dosen">NIK - Nama Dosen</label>
                        <select name="dosen" id="dosen" class="form-control" required>
                            @forelse($dosen as $d)
                                @if ($d->nik == $kelas->user_nik)
                                    <option value="{{ $d->nik }}" selected>
                                        {{ $d->nik }} - {{ $d->nama }}
                                    </option>
                                @else
                                    <option value="{{ $d->nik }}">
                                        {{ $d->nik }} - {{ $d->nama }}
                                    </option>
                                @endif
                            @empty
                                <option value="">Tidak Ada Dosen Aktif</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            @foreach(range('A', 'D') as $class)
                                @if ($class == $kelas->kelas)
                                    <option value="{{ $class }}" selected>{{ $class }}</option>
                                @else
                                    <option value="{{ $class }}">{{ $class }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('admin.matakuliah.matkuldetail', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id, 'matkul' => $matkul->id]) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
