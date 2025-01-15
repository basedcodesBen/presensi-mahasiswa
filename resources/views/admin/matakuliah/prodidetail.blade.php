@extends('layouts.master')

@section('title', 'Data Mata Kuliah')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Mata Kuliah - {{ $fakultas->nama_fakultas }} - {{ $programStudi->program_studi }}</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.matakuliah.create', ['fakultas' => $fakultas->id, 'prodi' => $programStudi->id]) }}" class="btn btn-primary m-2">Tambah Mata Kuliah</a>
                        <a href="{{ route('admin.matakuliah.fakultasdetail', $fakultas->id) }}" class="btn btn-danger m-2">Kembali</a>
                    </div>
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

                    @if(session('danger'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <li class="text-light font-weight-bold">
                                {{ session('danger') }}
                            </li>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none;">
                                <i class="ni ni-fat-remove opacity-100" style="font-size: 1.25rem;"></i>
                            </button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <li class="text-light font-weight-bold">
                                {{ session('error') }}
                            </li>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none;">
                                <i class="ni ni-fat-remove opacity-100" style="font-size: 1.25rem;"></i>
                            </button>
                        </div>
                    @endif

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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode</th>
                                    <th>Mata Kuliah</th>
                                    <th class="text-center">Total SKS</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($matakuliah as $mk)
                                <tr>
                                    <td class="text-center">{{ $mk->kode_matakuliah }}</td>
                                    <td>{{ $mk->nama_matakuliah }}</td>
                                    <td class="text-center">{{ $mk->sks }}</td>
                                    <td>
                                        <a href="{{ route('admin.matakuliah.matkuldetail', ['fakultas' => $fakultas->id, 'prodi' => $programStudi->id, 'matkul' => $mk->id]) }}" class="btn btn-primary ">
                                            View Class
                                        </a>
                                        <a href="{{ route('admin.matakuliah.edit', ['fakultas' => $fakultas->id, 'prodi' => $programStudi->id, 'matkul' => $mk->id]) }}" class="btn btn-warning ">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.matakuliah.destroy', ['fakultas' => $fakultas->id, 'prodi' => $programStudi->id, 'matkul' => $mk->id]) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data available</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
