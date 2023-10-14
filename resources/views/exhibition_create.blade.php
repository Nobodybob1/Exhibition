@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #FFC0CB;">Add Exhibition Art!</div>
                    <div class="card-body">
                        <form method="POST" action="/exhibition_store" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control">
                                @error('name')
                                    <p class="text-2 bg-warning">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="file-label" for="art_image">Add image of Art</label>
                                <input type="file" name="art_image" id="art_image" class="form-control-file no-file-text image" accept="image/*">
                            </div> 

                            {{-- Image Preview --}}
                            <img id="art-image-preview" class="image-preview" src="#" alt="Art Image Preview" style="display: none;">

                            <button type="submit" class="btn btn-warning text-white mt-2">Create!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection