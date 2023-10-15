@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="header">
            <h2>{{ $art->name }}</h2>
            <hr>
        </div>
        <div class="image">
            <img src="{{ asset('images/'. $art->image) }}" alt="Image" style="max-widht: 300px; max-height: 300px">
            <hr>
        </div>
        <div class="description">
            {{$art->description}}
            <hr>
        </div>
        <div class="row">
            @if ($art->ratings->isEmpty())
                <div class="col-md-4">
                    <p>This art haven't had rating yet</p>
                </div>
            @else
            <div class="col-md-4 rating">
                <p>Rating: {{$art->average_rating()}} of 5</p>
            </div>
            @endif 
            @if (auth()->user()->exhibitions()->whereId($art->id)->exists())
                <div class="col-md-4">This is your art!</div>
        </div>
                <a href="/art_update/{{$art->id}}" class="btn col-md-6 text-center text-white mt-3" style="background-color: #FFC0CB;">Update this art</a>
            @elseif (auth()->user())
                @if (auth()->user()->ratings()->where('exhibition_id', $art->id)->exists())
                <div class="form-control col-md-8">
                    <form action="/update_rate_art/{{ $art->id }}" method="post">
                        @csrf
                        @method("patch")

                        <label for="rating">You already Rated this. Rate again?</label>
                        <input type="number" name="rating" min="1" max="5" value="{{ auth()->user()->ratings()->where('exhibition_id', $art->id)->get()->first()->rating }}">
                        <button type="submit" class="m-1">Submit Rating</button>
                    </form>
                </div>
                @else
                    <div class="form-control col-md-8">
                        <form action="/rate_art/{{$art->id}}" method="post">
                            @csrf

                            <label for="rating">Rate this art 1 to 5:</label>
                            <input type="number" name="rating" min="1" max="5">
                            <button type="submit" class="m-1">Submit Rating</button>
                        </form>
                    </div>
            @endif
                
    </div>
            @else
            <p>Login to rate</p>
            @endif
    <hr>
    <div class="comment-section">
        <h4 class="text-center">Comment Section</h4>
        @auth
            <form method="POST" action="/art/{{ $art->id }}/comment">
            @csrf
            
            <div class="form-group">
                <label for="comment">Add a Comment:</label>
                <textarea name="comment" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-warning text-white">Comment!</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">log in</a> to leave a comment.</p>
        @endauth
        @unless ($art->comments->isEmpty())
            @foreach ($art->comments()->latest()->get() as $comment)
            <div class="row mt-5 border p-3">
                <div class="col-md-2">
                    <img src="{{ asset('/images/'. $comment->user->profile_image) }}" alt="Profile Image" style="max-width:100px; max-height:100px;">
                </div>
                <div class="col-md-2">
                    <p><strong><a href="/profile/{{ $comment->user->id }}" class="text-dark">{{ $comment->user->name }}</a></strong></p>
                </div>
                <div class="col-md-8 text-left">
                    {{ $comment->comment }}
                </div>
            </div>
            @endforeach
        @endunless
    </div>
@endsection