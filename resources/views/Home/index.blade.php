@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection
@section('content')
    <div class="p-4" class="bg-white">
        <div class="row">
            <div class="col-md-4 text-center">
                @if (Auth::user()->profile != null)
                    <div>
                        <img src="{{ asset('storage/' . Auth::user()->profile->profilepic) }}" alt=""
                            style="max-width: 10rem; border-radius: 50%; border: 2px solid blue;" class="mx-auto">
                    </div>
                @else
                    <img src="{{ asset('assets\images\profile_dummy.png') }}" alt=""
                        style="max-width: 10rem; border-radius: 50%; border: 2px solid blue;" class="mx-auto">
                @endif
                <div style="font-size:1.5rem;" class="m-2">
                    <b> {{ Auth::user()->name }} </b>
                </div>
                <div style="font-size:1rem;" class="m-2">
                    {{ Auth::user()->profile->bio }}
                </div>
                <div class="m-2 text-right">
                    <a href="{{ 'user/profile/edit/' . Auth::user()->id }}"><i class="fa fa-pencil"> Edit Profile </i></a>
                </div>
                <div class="footer sticky-bottom">
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
            <div class="col-md-8 ">
                @if (session()->has('message'))
                    <br>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('fail'))
                    <br>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session()->get('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card p-3 postbox">
                    <h3 class=" card-title">
                        Make a Post
                    </h3>
                    <form action="{{ route('post.add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea required name="desc" id="desc" maxlength="160" placeholder="Write your mind..."
                                rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group pt-2">
                            <input type="submit" value="Post" class="btn btn-primary">
                        </div>
                    </form>
                </div>

                <hr>
                @foreach ($list as $item)
                    <div class=" mt-2 mb-2">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title mb-0 d-flex justify-content-between" style="font-size:1.1rem;">
                                    <span>
                                        <b>{{ $item->user->name }}</b> -
                                        <small class="text-muted">Posted {{ $item->updated_at->diffForHumans() }}</small>
                                    </span>
                                    <span>
                                        @if ($item->user->id == Auth::user()->id)
                                            <button class="" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                style="outline: none;">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#edit-{{ $item->id }}">Edit</button></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('post.delete', ['post' => $item->id]) }}">Delete</a>
                                                </li>
                                            </ul>
                                            <!-- Modal for Editing Post -->
                                            <div class="modal fade" id="edit-{{ $item->id }}" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card p-3 postbox">
                                                            <h3 class=" card-title">
                                                                Edit a Post
                                                            </h3>
                                                            <form action="{{ route('post.edit', ['post' => $item->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <textarea required name="desc" id="desc" maxlength="160"
                                                                        placeholder="Write your mind..." rows="2"
                                                                        class="form-control">{{ $item->desc }}</textarea>
                                                                </div>
                                                                <div class="form-group pt-2">
                                                                    <input type="submit" value="Update"
                                                                        class="btn btn-primary">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </span>
                                </h5>
                                <p class="card-text">
                                <pre><div style="font-size:0.9rem;color:rgb(57, 57, 255);padding-left:10px;min-height:60px;margin-top:5px;">{!!  $item->desc !!}</div></pre>

                                </p>

                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $list->links() }}
            </div>
        </div>
    </div>

@endsection
