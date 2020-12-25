@extends('auth.layout')

@section('content')

    <div class="p-5" style="background:#1216ff;height:100vh;">
        <div class="row">
            <div class="col-md-6 ">
                something
            </div>
            <div class="col-md-6 shadow p-3 bg-white">
                <div class="text-middle mb-2">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" style="height: 32px; width:32px;">
                </div>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Full Name" name="name" value="{{old('name')}}">
                        <label for="floatingInput">Full Name</label>
                        <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="{{old('email')}}">
                        <label for="floatingInput">Email address</label>
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Password</label>
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-floating">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
