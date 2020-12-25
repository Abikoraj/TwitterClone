@extends('auth.layout')

@section('content')

    <div class="container">
        <div class="row" style="margin-top: 45px">
            <div class="col-4 offset-md-4 shadow p-3">
                <h3 class="text-center">Create Profile</h3>
                <hr>
                <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3 text-center">
                        <img src="{{asset('assets/images/profile_dummy.png')}}" id="profileDisplay" onclick="triggerClick()">
                        <label for="profilepic">Profile Image</label>
                        <input type="file" name="profilepic" onchange="displayImage(this)" id="profilepic" style="display: none;">
                        <span class="text-danger">@error('profilepic'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio" class="form-control" required></textarea>
                        <span class="text-danger">@error('bio'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        {{-- <a href="{{ route('home') }}" class="float-end">Skip</a> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function triggerClick(){
            document.querySelector('#profilepic').click();
        }

        function displayImage(e){
            if (e.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e){
                    document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>

@endsection
