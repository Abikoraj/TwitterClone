@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection
@section('content')

    <div class="p-4" class="bg-white">
        <div class="row">
            <div class="col-md-4 text-center">
                {{-- @if (Auth::user()->profile != null)
                    <div>
                        <img src="{{ asset('storage/' . Auth::user()->profile->profilepic) }}" alt=""
                            style="max-width: 10rem; border-radius: 50%; border: 2px solid blue;" class="mx-auto">
                    </div>
                    @else
                    <img src="{{ asset('assets\images\profile_dummy.png') }}" alt=""
                        style="max-width: 10rem; border-radius: 50%; border: 2px solid blue;" class="mx-auto">
                @endif --}}
                <div>
                    <img src="{{ asset('storage/' . $user->profile->profilepic) }}" alt=""
                        style="max-width: 10rem; border-radius: 50%; border: 2px solid blue;" class="mx-auto">
                </div>
                <div style="font-size:1.5rem;" class="m-2">
                    <b> {{ $user->name }} </b>
                </div>
                <div style="font-size:1rem;" class="m-2">
                    {{ $user->profile->bio }}
                </div>
                @if ($user->id == Auth::user()->id)
                    <div class="m-2 text-right">
                        <a href="{{ 'user/profile/edit/' . Auth::user()->id }}">
                            <i class="fa fa-pencil"> Edit Profile</i>
                        </a>
                    </div>
                @endif
            </div>
            {{ $user->name }}
            {{-- {{ $post->desc }} --}}
            <div class="col-md-8 ">
                <hr>
                @foreach ($post as $item)
                    <div class=" mt-2 mb-2">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title mb-0 d-flex justify-content-between" style="font-size:1.1rem;">
                                    <span>
                                        <b>{{ $user->name }}</b> -
                                        <small class="text-muted">Posted </small>
                                    </span>
                                </h5>
                                <p class="card-text">
                                <pre>
                                    <div style="font-size:0.9rem;color:rgb(57, 57, 255);padding-left:10px;min-height:60px;margin-top:5px;">
                                        {{ $item->desc }}
                                    </div>
                                </pre>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- {{ $item->links() }} --}}
            </div>
        </div>
    </div>

@endsection
