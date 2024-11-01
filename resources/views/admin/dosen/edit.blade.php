@extends('layouts.master')

@section('title', 'Edit Data Dosen')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="m-0">Edit Data Dosen</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- NIK Field -->
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" value="{{ $dosen->nik }}" required>
                    </div>

                    <!-- Nama Field -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $dosen->nama }}" required>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $dosen->email }}" required>
                    </div>

                    <!-- Program Studi Field -->
                    <div class="form-group">
                        <label for="program_studi_id">Program Studi</label>
                        <select name="program_studi_id" id="program_studi_id" class="form-control" required>
                            @foreach($programStudis as $programStudi)
                                <option value="{{ $programStudi->id }}" {{ $dosen->program_studi_id == $programStudi->id ? 'selected' : '' }}>
                                    {{ $programStudi->program_studi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Save Button -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
