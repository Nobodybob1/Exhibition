@extends('layouts.app')

@section('content')
    @if(session('message'))
        <div class="alert alert-success message-alert" style="display: none;">
            {{ session('message') }}
        </div>
    @endif
    {{-- {{ dd(session('not_allowed')) }} --}}
    @if (session('not_allowed'))
        <div class="alert alert-danger message-alert" style="display: none;">
            {{ session('not_allowed') }}
        </div>
    @endif
    <h2>Welcome to Exhibition!</h2>
    <p>Discover amazing pieces of art from around the world.</p>
@endsection
