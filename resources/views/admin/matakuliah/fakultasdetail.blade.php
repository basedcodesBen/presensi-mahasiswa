@extends('layouts.master')

@section('title', 'Data Mata Kuliah')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Mata Kuliah - {{ $fakultas->nama_fakultas }}</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.matakuliah.index') }}" class="btn btn-danger m-2">Kembali</a>
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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Program Studi</th>
                                    <th class="text-center">Total Mata Kuliah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($programStudi as $program)
                                    <tr>
                                        <td class="text-center">{{ $program->id }}</td>
                                        <td>{{ $program->program_studi }}</td>
                                        <td class="text-center">{{ $matakuliah[$program->id] ?? 0 }}</td>
                                        <td>
                                            <a href="{{ route('admin.matakuliah.prodidetail', ['fakultas' => $fakultas->id, 'prodi' => $program->id]) }}" class="btn btn-primary btn-sm">
                                                View Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
