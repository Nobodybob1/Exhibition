@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Update {{ $art->name }}</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #FFC0CB;">Update Your Art!</div>
                    <div class="card-body">
                        <form method="post" action="/art_update/{{ $art->id }}" enctype="multipart/form-data">
                            @csrf
                            @method("patch")
                            
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" name="name" value="{{ $art->name }}" required autofocus class="form-control">
                                @error('name')
                                    <p class="text-2 bg-warning">{{$message}}</p>
                                @enderror
                            </div>
        
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $art->description }}</textarea>
                            </div>
        
                            <button type="submit" class="btn btn-warning text-white mt-2">Update!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection