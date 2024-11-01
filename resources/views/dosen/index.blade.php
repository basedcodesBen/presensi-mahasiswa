@extends('layouts.master')

@section('title', 'Dosen Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Hello, {{ Auth::user()->nama }}!</h4>
                </div>
                <div class="card-body">
                    <p>Welcome to your dashboard!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
