@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Exhibition!</h2>
        <form action="/art/search" method="GET">
            <div class="input-group mb-5">
                <input type="text" name="search" class="form-control" placeholder="Search Arts by Name">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
        
        @if (!$arts->isEmpty() && $search->isEmpty())
            <div class="row">
                @foreach ($arts as $art)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('/images/'. $art->image) }}" alt="Artwork Image" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $art->name }}</h5>
                                <a href="/exhibition_single/{{ $art->id }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif (!$search->isEmpty())
            <div class="row">
                @foreach ($search as $art)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('/images/'. $art->image) }}" alt="Artwork Image" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $art->name }}</h5>
                                <a href="/exhibition_single/{{ $art->id }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Nothing to show.</p>
        @endif
    </div>
@endsection