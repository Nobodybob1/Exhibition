@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #FFC0CB;">Register</div>
                    <div class="card-body">
                        <form method="POST" action="/register_user">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control">
                                @error('name')
                                    <p class="text-2 bg-warning">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control">
                                @error('email')
                                    <p class="text-2 bg-warning">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password" required class="form-control">
                                @error('password')
                                    <p class="text-2 bg-warning">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select id="role_id" name="role_id" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
