@extends('layouts.master')

@section('title', 'Create Mata Kuliah')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Kelas</h4>
                    <p>Tambah data Mahasiswa disini</p>
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
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <li class="text-light font-weight-bold">
                                {{ session('success') }}
                            </li>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none;">
                                <i class="ni ni-fat-remove opacity-100" style="font-size: 1.25rem;"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <h4 class="m-3">{{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }}</h4>
                    <div class="mb-3">
                        <label for="dosen">Dosen</label>
                        <input type="text" class="form-control" id="dosen" name="dosen" value="{{ $dosen->nama }}" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $class->kelas }}" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="mahasiswakelas">Mahasiswa yang sudah di Kelas</label>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">NIK</th>
                                    <th class="text-center">Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($murid as $mhs)
                                    <tr>
                                        <td class="text-center">{{ $mhs->user_nik }}</td>
                                        <td class="text-center">{{ $mhs->mahasiswa->nama }}</td>
                                        <td>
                                            <form action="{{  route('admin.matakuliah.destroyMahasiswa', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id, 'matkul' => $mk->id, 'kelas' => $class->id, 'mahasiswa' => $mhs->user_nik]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <form action="{{ route('admin.matakuliah.storeMahasiswa', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id, 'matkul' => $mk->id, 'kelas' => $class->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="mahasiswa">Assign Mahasiswa</label>
                            <div id="mahasiswa">
                                @foreach($mahasiswa as $mhs)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mahasiswa[]" value="{{ $mhs->nik }}" id="mahasiswa{{ $mhs->nik }}">
                                    <label class="form-check-label" for="mahasiswa{{ $mhs->nik }}">
                                        {{ $mhs->nik }} - {{ $mhs->nama }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('admin.matakuliah.matkuldetail', ['fakultas' => $faculty->id, 'prodi' => $programStudi->id, 'matkul' => $mk->id]) }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
