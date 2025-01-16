@extends('layouts.master')

@section('title', 'Data Dosen')

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
            outline: none; /* Remove outline */
        }

        .text-link:hover {
            color: #495057;
        }

        .text-link + .text-link {
            margin-left: 10px; /* Adds margin between Edit and Delete links */
        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Dosen</h4>
                    <p>A lightweight, extendable, dependency-free javascript HTML table plugin.</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Entries Per Page and Search Bar -->
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label>
                                Show
                                <select class="form-control d-inline-block w-auto" name="entries">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                entries per page
                            </label>
                        </div>
                    </div>

                    <!-- Table for Dosen Data -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">NIK</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Program Studi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td class="text-center">{{ $dosen->nik }}</td>
                                    <td>{{ $dosen->nama }}</td>
                                    <td>{{ $dosen->email }}</td>
                                    <td>{{ $dosen->programStudi->program_studi }}</td>
                                    <td>
                                        <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" id="delete">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination and Entries Info -->
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Showing 1 to {{ $dosens->count() }} of {{ $dosens->total() }} entries</p>
                        <nav>
                            {{ $dosens->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.confirm')
    @include('layouts.alerts')
@endsection
