@extends('layouts.master')

@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Dashboard Overview</h4>
                </div>
                <div class="card-body">
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection