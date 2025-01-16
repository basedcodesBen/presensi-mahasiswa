@extends('layouts.master')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Mahasiswa</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label>
                                Show
                                <select class="form-control d-inline-block w-auto" name="entries" onchange="window.location.href=this.value;">
                                    <option value="{{ route('admin.mahasiswa.index', ['entries' => 10]) }}" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="{{ route('admin.mahasiswa.index', ['entries' => 25]) }}" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="{{ route('admin.mahasiswa.index', ['entries' => 50]) }}" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="{{ route('admin.mahasiswa.index', ['entries' => 100]) }}" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                entries per page
                            </label>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">NRP</th>
                                <th>Nama</th>
                                <th>Fakultas</th>
                                <th>Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td class="text-center">{{ $student->nik }}</td>
                                    <td>{{ $student->nama }}</td>
                                    <td>{{ $student->programStudi->fakultas->nama_fakultas ?? 'N/A' }}</td>
                                    <td>{{ $student->programStudi->program_studi }}</td>
                                    <td>
                                        <a href="{{ route('admin.mahasiswa.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.mahasiswa.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" id="delete">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data Mahasiswa tidak tersedia.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center align-items-center">
                        <div>
                            {{ $students->appends(request()->input())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.confirm')
    @include('layouts.alerts')
@endsection
