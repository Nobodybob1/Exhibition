@extends('layouts.admin_app')

@section('content')
    <div class="content">
        <h1>Admin Page!</h1>
        <h5>Welcome, {{ auth()->user()->name }}</h5>
    </div>
@endsection