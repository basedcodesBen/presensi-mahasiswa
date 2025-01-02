@extends('layouts.master')

@section('title', 'Tambah Program Studi')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Tambah Program Studi</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.prodi.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Menampilkan pesan sukses atau error -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form untuk menambahkan program studi -->
                    <form action="{{ route('admin.prodi.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="program_studi">Nama Program Studi</label>
                            <input type="text" class="form-control" id="program_studi" name="program_studi" value="{{ old('program_studi') }}" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
