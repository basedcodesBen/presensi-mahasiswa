@extends('layouts.master')

@section('title', 'Create Program Studi')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Data Program Studi</h4>
                    <p>Tambah data Program Studi disini</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.programstudi.store') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.programstudi.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        <div class="mb-3">
                            <label for="program_studi" class="form-label">Program Studi</label>
                            <input type="text" class="form-control" id="program_studi" name="program_studi" placeholder="Enter Nama Program Studi" required>
                        </div>
                        <div class="form-group">
                            <label for="fakultas_id">Fakultas</label>
                            <select name="fakultas_id" id="fakultas_id" class="form-control" required>
                                @foreach($fakultas as $faculty)
                                    <option value="{{ $faculty->id }}">
                                        {{ $faculty->nama_fakultas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
