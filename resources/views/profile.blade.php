@extends('layouts.app')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    div#social-links ul li {
        display: inline-block;
    }          
    div#social-links ul li a {
        padding: 20px;
        border: 1px solid #ccc;
        margin: 1px;
        font-size: 30px;
        color: #222;
        background-color: #FFC0CB;
    }
</style> --}}

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
                        @if (auth()->user()->id == $user->id)
                            <a href="{{ $favorite->art->getFacebookShareLink() }}"  target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                            </svg></a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endunless
    </div>
    {{-- <div class="section">
        <h4 class="text-center mb-5 mt-5">Share to social media?</h4>
        {!! $shareComponent !!}
    </div> --}}
</div>
@endsection
