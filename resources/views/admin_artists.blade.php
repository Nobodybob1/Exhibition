@extends('layouts.admin_app')

@section('content')
    @if (session('message'))
            <div class="alert alert-danger message-alert" style="display: none;">
                {{ session('message') }}
            </div>
    @endif
    <div class="content">
        <h2 class="text-center">All artists!</h2>
        <p class="text-center"><a href="/add_artist" class="btn btn-success" style="background-color: #FFC0CB; border:none">Add an Artist</a></p>
        @unless ($artists->isEmpty())
            @foreach ($artists as $artist)
                <div class="row mt-5 text-center">
                    <img src="{{ asset('/images/'. $artist->profile_image) }}" alt="Profile Image" class="col-md-4 img-fluid">
                    <p class="col-md-2 mt-5">{{ $artist->name }}</p>
                   
                    @if ($artist->is_blocked == 1)
                        <p class="mt-5"><strong>User is blocked</strong></p>
                    @else
                    <form method="post" action="/block_artist/{{ $artist->id }}">
                        @csrf
                        @method('patch')

                        <button class="btn btn-danger col-md-6 mt-4 text-center pr-5" type="submit">Block Artist</button>
                    </form>
                    @endif
                </div>
            @endforeach
        
        @endunless
    </div>
@endsection