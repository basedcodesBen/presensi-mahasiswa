@extends('layouts.master')

@section('title', 'Data Program Studi')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Program Studi</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.programstudi.create') }}" class="btn btn-primary">Tambah Program Studi</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Program Studi</th>
                                <th>Fakultas</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($prodis as $prodi)
                                <tr>
                                    <td class="text-center">{{ $prodi->id }}</td>
                                    <td>{{ $prodi->program_studi }}</td>
                                    <td>{{ $prodi->fakultas->nama_fakultas ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.programstudi.edit', $prodi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.programstudi.destroy', $prodi->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" id="delete">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data Program Studi tidak tersedia.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $prodis->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.confirm')
    @include('layouts.alerts')
@endsection
