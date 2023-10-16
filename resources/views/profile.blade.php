@extends('layouts.app')

@section('content')
@if(session('message'))
    <div class="alert alert-success" id="message-alert" style="display: none;">
        {{ session('message') }}
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="text-center">
                <div class="profile-image">
                    <!-- User's Profile Image -->
                <img src="{{ asset('/images/'. $user->profile_image) }}" alt="Profile Image" class="profile-image">
                </div>
                
                <!-- Image preview -->
                <img class="image-preview" id="profile-image-preview" src="#" alt="Profile Image Preview" style="display: none; position: absolute; max-width: 100%">
            </div>
        </div>
        <div class="col-md-7">
            <h2>{{$user->name}} ({{$user->role->role_name}})</h2>
            @if (auth()->user()->id === $user->id)
                <form method="POST" action="/change_profile_image" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label class="file-label" for="profile_image">Change Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control-file no-file-text image" accept="image/*">
                    </div>                

                    <button type="submit" class="btn text-white" style="background-color: #FFC0CB;">Update Profile Image</button>
                </form>
                @if (auth()->user()->role->role_name == 'artist')
                    <a href="/exhibition_create" class="btn btn-warning text-white mt-3">Create Exhibition Art</a>
                @else
                    
                @endif
            @endif
            <!-- Edit Profile Form -->
            
        </div>
    </div>
    <div class="container text-center">
        @unless ($user->exhibitions->isEmpty())
        <div class="row">
            @foreach ($user->exhibitions as $art)
                <div class="col-md-4 mt-5">
                    <img src="{{asset('/images/'. $art->image)}}" alt="Image of art" class="img-fluid">
                    <a href="/exhibition_single/{{$art->id}}" class="text-dark"><h4>{{$art->name}}</h4></a>
                </div>
            @endforeach
        </div>   
        @endunless
    </div>
    <div class="container text-center">
        <h2>Favorites:</h2>
        @unless ($user->favorites->isEmpty())
            <div class="row">
                @foreach ($user->favorites as $favorite)
                    <div class="col-md-4 mt-5">
                        <img src="{{asset('/images/'. $favorite->art->image)}}" alt="Image of art" class="img-fluid">
                        <a href="/exhibition_single/{{$favorite->art->id}}" class="text-dark"><h4>{{$favorite->art->name}}</h4></a>
                    </div>
                @endforeach
            </div>
        @endunless
    </div>
</div>
@endsection
