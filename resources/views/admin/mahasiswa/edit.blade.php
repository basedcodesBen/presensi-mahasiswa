@extends('layouts.master')

@section('title', 'Edit Data Mahasiswa')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="m-0">Edit Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.fakultas.update', $fakultas->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" value="{{ $mahasiswa->nik }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $mahasiswa->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="program_studi_id">Program Studi</label>
                        <select name="program_studi_id" id="program_studi_id" class="form-control" required>
                            @foreach($programStudis as $programStudi)
                                <option value="{{ $programStudi->id }}" {{ $mahasiswa->program_studi_id == $programStudi->id ? 'selected' : '' }}>
                                    {{ $programStudi->program_studi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('admin.fakultas.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
