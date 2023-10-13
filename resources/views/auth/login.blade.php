@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #FFC0CB;">Login</div>
                    <div class="card-body">
                        <form method="POST" action="/login_user">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password" required class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <p>{{ Session::get('error') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
