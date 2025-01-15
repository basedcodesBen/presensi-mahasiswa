@extends('layouts.master')

@section('title', 'Edit Data Fakultas')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="m-0">Edit Data Fakultas</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.fakultas.update', $fakultas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $fakultas->nama_fakultas }}" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('admin.fakultas.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
