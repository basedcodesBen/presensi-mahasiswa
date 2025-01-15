@extends('layouts.master')

@section('content')
    <div class="container mt-5 text-center">
        <h1>{{ session('message') }}</h1>
    </div>
@endsection
