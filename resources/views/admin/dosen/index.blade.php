@extends('layouts.master')

@section('title', 'Data Dosen')

@section('content')
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
                        <div>
                            <form action="{{ route('admin.dosen.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" placeholder="Type here..." value="{{ request('q') }}">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table for Dosen Data -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Program Studi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td>{{ $dosen->nik }}</td>
                                    <td>{{ $dosen->nama }}</td>
                                    <td>{{ $dosen->email }}</td>
                                    <td>{{ $dosen->program_studi }}</td> <!-- Ensure this is set correctly -->
                                    <td>
                                        <!-- Edit Button -->
                                        <!-- Delete Form -->
                                        <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
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
@endsection
