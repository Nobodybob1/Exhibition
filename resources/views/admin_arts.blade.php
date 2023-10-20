@extends('layouts.admin_app')

@section('content')
    <div class="container">
        <h2 class="text-center">Exhibition!</h2>

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
    </div>
@endsection