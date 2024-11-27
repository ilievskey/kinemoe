@extends('layouts.app')

@section('content')
    @if (Auth::check() && !Auth::user()->isAdmin())
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        @if (Auth::user()->isBanned())
                            <div class="alert alert-danger">
                                Your account is banned. Please contact support for more information.
                            </div>
                        @else
                            <div class="alert alert-info">
                                You have {{ Auth::user()->warnings_count }} warnings.
                            </div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif

                            <form method="POST" action="{{ route('dashboard.update') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $user->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <small class="form-text text-muted">Leave blank if you don't want to change the
                                        password.</small>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input type="password" class="form-control" id="password-confirm"
                                        name="password_confirmation">
                                </div>

                                <div class="form-group">
                                    <label for="profile_picture">Profile Picture</label>
                                    <input type="file" class="form-control-file" id="profile_picture"
                                        name="profile_picture">
                                    @if ($user->profile_picture)
                                        <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture"
                                            class="img-thumbnail mt-2" width="150">
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>

                            <div class="card mt-4">
                                <div class="card-header">Your Posts</div>
                                <div class="card-body">
                                    @forelse ($posts as $post)
                                        <p class="mb-0"><a href="/post/{{$post->id}}">{{ $post->post_title }}</a> <button class="btn btn-danger btn-sm delete-post" data-url="{{ route('posts.destroy', $post->id) }}" data-token="{{ csrf_token() }}">🗑️</button></p>
                                        <p>{{ $post->post_content }}</p>
                                        <hr>
                                    @empty
                                        <p>No more posts available.</p>
                                    @endforelse
                                    {{ $posts->links('pagination::bootstrap-5') }}
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-header">Your Comments</div>
                                <div class="card-body">
                                    @forelse ($comments as $comment)
                                        <p>{{ $comment->comment_content }} <button class="btn btn-danger btn-sm delete-comment" data-url="{{ route('comments.destroy', $comment->id) }}" data-token="{{ csrf_token() }}">🗑️</button></p>
                                        <hr>
                                    @empty
                                        <p>No more comments available.</p>
                                    @endforelse
                                    {{ $comments->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>

                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    @elseif (Auth::check() && Auth::user()->isAdmin())
    <div class="d-flex">
        <div id="dash-side" class="d-flex flex-column sidebar">
            <div id="dash-name" class="d-flex align-items-center justify-content-center link-dark text-decoration-none py-5 px-2" >
                <span class="fs-3">Admin Dashboard</span>
            </div>
            @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
            <ul id="dash-items" class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link link-dark active d-flex justify-content-center" id="home-link" data-url="{{ route('admin.home') }}">
                        📊 <p class="m-0">Home</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark d-flex justify-content-center" id="users-link" data-url="{{ route('admin.users') }}">
                        👥 <p class="m-0">Users</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark d-flex justify-content-center" id="report-link" data-url="{{ route('admin.reports') }}">
                        😡 <p class="m-0">Reports</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark d-flex justify-content-center" id="content-link" data-url="{{ route('admin.content') }}">
                        🎞️ <p class="m-0">Content</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark d-flex justify-content-center" id="system-link" data-url="{{ route('admin.settings') }}">
                        ⚙️ <p class="m-0">System</p>
                    </a>
                </li>
            </ul>
        </div>
        <div id="dash-content" class="dash-content w-100">
            <p>Dashboard loading...</p>
            <h1 id="loading-circle">.</h1>
        </div>
    </div>
    @else
        <div class="card">
            <div class="card-header">Dashboard</div>
            <p>you are not logged in</p>
        </div>
    @endif
@endsection
