@extends('layouts.app')

@section('content')
    @if(session('message'))
        <div class="alert alert-success" id="message-alert" style="display: none;">
            {{ session('message') }}
        </div>
    @endif
    <h2>Welcome to Exhibition!</h2>
    <p>Discover amazing pieces of art from around the world.</p>
@endsection
