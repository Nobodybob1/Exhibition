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
                <div class="col-md-6">
                    <p>This art haven't had rating yet</p>
                </div>
            @else
            <div class="col-md-6 rating">
                <p>Rating: {{$art->average_rating()}} of 5</p>
            </div>
            @endif 
            <div class="form-control col-md-6">
                <form action="/rate_art/{{$art->id}}" method="post">
                    @csrf
    
                    <label for="rating">Rate this art 1 to 5:</label>
                    <input type="number" name="rating" min="1" max="5">
                    <button type="submit">Submit Rating</button>
                </form>
            </div>
        </div>
    </div>
@endsection