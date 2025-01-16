@extends('layouts.master')

@section('title', 'Data Fakultas')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Fakultas</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.fakultas.create') }}" class="btn btn-primary">Tambah Fakultas</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Nama Fakultas</th>
                                    <th>Program Studi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faculties as $faculty)
                                    <tr>
                                        <td class="text-center">{{ $faculty->id }}</td>
                                        <td>{{ $faculty->nama_fakultas }}</td>
                                        <td>
                                            @foreach ($faculty->fakultas as $program)
                                                <span>- {{ $program->program_studi }}</span><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.fakultas.edit', $faculty->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.fakultas.destroy', $faculty->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" id="delete">Hapus</button>
                                            </form>
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
    @include('layouts.confirm')
    @include('layouts.alerts')

@endsection
