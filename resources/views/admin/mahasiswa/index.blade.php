@extends('layouts.master')

@section('title', 'Data Mahasiswa')

@section('content')

    <style>
        .text-link {
            background: none;
            border: none;
            color: #6c757d;
            text-decoration: underline;
            cursor: pointer;
            font-size: inherit;
            padding: 0;
            outline: none;
        }

        .text-link:hover {
            color: #495057;
        }

        .text-link + .text-link {
            margin-left: 10px;
        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Mahasiswa</h4>
                    <p>A lightweight, extendable, dependency-free javascript HTML table plugin.</p>
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
                                    <option value="{{ route('admin.mahasiswa.index', ['entries' => 5]) }}" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
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
                                    <th>Nama</th>
                                    <th>NRP</th>
                                    <th>Fakultas</th>
                                    <th>Program Studi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->nama }}</td>
                                    <td>{{ $student->nik }}</td>
                                    <td>{{ $student->programStudi->fakultas->nama_fakultas ?? 'N/A' }}</td>
                                    <td>{{ $student->programStudi->program_studi }}</td>
                                    <td>
                                        <a href="{{ route('admin.mahasiswa.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.mahasiswa.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <p>Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} entries</p>
                        {{ $students->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
