@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="text-center">
                <!-- User's Profile Image -->
                <img src="{{ asset('/images/'. $user->profile_image) }}" alt="Profile Image" class="profile-image">
            </div>
        </div>
        <div class="col-md-7">
            <h2>{{$user->name}} ({{$user->role->role_name}})</h2>

            <!-- Edit Profile Form -->
            <form method="POST" action="/change_profile_image" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label class="file-label" for="profile_image">Change Profile Image</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control-file no-file-text">
                </div>                

                <button type="submit" class="btn" style="background-color: #FFC0CB; color:#fff">Update Profile Image</button>
            </form>
        </div>
    </div>
</div>
@endsection
