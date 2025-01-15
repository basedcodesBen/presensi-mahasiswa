@extends('layouts.master')

@section('title', 'Edit Data Program Studi')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="m-0">Edit Data Program Studi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.programstudi.update', $prodi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="program_studi">Program Studi</label>
                        <input type="text" name="program_studi" id="program_studi" class="form-control" value="{{ $prodi->program_studi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="fakultas_id">Fakultas</label>
                        <select name="fakultas_id" id="fakultas_id" class="form-control" required>
                            @foreach($fakultas as $faculty)
                                @if($prodi->fakultas_id == $faculty->id)
                                    <option value="{{ $faculty->id }}" selected>
                                        {{ $faculty->nama_fakultas }}
                                    </option>
                                @else
                                    <option value="{{ $faculty->id }}">
                                        {{ $faculty->nama_fakultas }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('admin.programstudi.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
