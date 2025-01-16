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
                                            <button type="submit" class="btn btn-danger" id="delete">Hapus</button>
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
    @include('layouts.confirm')
    @include('layouts.alerts')
@endsection
