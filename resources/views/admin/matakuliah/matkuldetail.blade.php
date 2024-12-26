@extends('layouts.master')

@section('title', 'Data Mata Kuliah')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Mata Kuliah - {{ $fakultas->nama_fakultas }} - {{ $programStudi->program_studi }}</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.matakuliah.createdosen',  ['fakultas' => $fakultas->id, 'prodi' => $programStudi->id, 'matkul' => $matkul->id]) }}" class="btn btn-primary m-2">Tambah Dosen</a>
                        <a href="#" class="btn btn-danger m-2">Kembali</a>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none;">
                                <i class="ni ni-fat-remove opacity-100" style="font-size: 1.25rem;"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('danger'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session('danger') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none;">
                                <i class="ni ni-fat-remove opacity-100" style="font-size: 1.25rem;"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">                    
                    <h4 class="m-0">{{ $matkul->kode_matakuliah }} - {{ $matkul->nama_matakuliah }}</h4>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">NIK Dosen</th>
                                    <th>Nama Dosen</th>
                                    <th class="text-center">Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($dosen as $user)
                                @foreach($user->dosen as $d)
                                <tr>
                                    <td class="text-center">{{ $user->nik }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td class="text-center">{{ $d->kelas ?? '-' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
