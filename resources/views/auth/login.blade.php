@extends('auth.layout')

@section('title','Login')
@section('content')
<div class="container">
    <div class="row" style="margin-top: 45px">
        <div class="col-md-4 p-3 offset-md-4 shadow">
            <h4>User Login</h4>
            <hr>
            <form action="" method="POST">
                @csrf
                <div class="mb-2 form-floating">
                    <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') }}">
                    <label for="email">Email</label>
                    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                </div>
                <div class="mb-2 form-floating">
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                    <label for="password">Password</label>
                    <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                </div>
                <div class="form-floating d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <br>
                <a href="{{route('register')}}">Create an new Account now!</a>
            </form>
        </div>
    </div>
</div>
@endsection
