@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="header">
            <h2>{{ $art->name }}</h2>
            <hr>
        </div>
        <div class="image">
            <img src="{{ asset('images/'. $art->image) }}" alt="Image">
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
                @endif
            </div>
        </div>
            @else
            <p>Login to rate</p>
            @endif
    </div>
@endsection