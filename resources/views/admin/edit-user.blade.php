@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>

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

                    <form id="admin-edit-user" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group profile-pic">
                            @if ($user->profile_picture)
                                <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture"
                                    class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="form-group w-100">
                                <label for="badge">Badge</label>
                                <select class="form-control" id="badge" name="badge">
                                    <option value="">None</option>
                                    <option value="👨‍🍳" {{ $user->badge == '👨‍🍳' ? 'selected' : '' }}>👨‍🍳</option>
                                    <option value="☑️" {{ $user->badge == '☑️' ? 'selected' : '' }}>☑️</option>
                                    <option value="⚙️" {{ $user->badge == '⚙️' ? 'selected' : '' }}>⚙️</option>
                                </select>
                            </div>
                            
                            <div class="form-group w-100">
                                <label for="user_role">User Role</label>
                                <select name="user_role" class="form-control" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->user_role == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if($user->user_role == 3)
                            <div class="form-group">
                                <label for="biography">Biography</label>
                                <textarea name="biography" class="form-control">{{ $user->biography }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="awards">Awards</label>
                                <input type="number" name="awards" class="form-control" value="{{ $user->awards }}">
                            </div>

                            {{-- stvari za content linking --}}
                            <div class="form-group">
                                <label for="linked_content">Link Content</label>
                                <div class="form-check">
                                    @foreach($contents as $content)
                                        <div>
                                            <input type="checkbox" name="linked_content[]" value="{{ $content->id }}" 
                                                   {{ in_array($content->id, $linkedContents) ? 'checked' : '' }}>
                                            <label>{{ $content->title }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="d-flex pt-3">
                            <div>
                                <button type="submit" class="btn btn-primary my-2">Update User</button>
                                @if (!$user->isAdmin())
                                    <button type="button" id="delete-user" class="btn btn-danger" data-url="{{ route('admin.users.delete', $user->id) }}" data-token="{{ csrf_token() }}">Delete User</button>
                                @endif
                            </div>
                            <div class="ms-auto">
                                @if (!$user->isAdmin())
                                    @if ($user->isBanned())
                                        <button type="submit" name="unban" class="btn btn-warning">Unban User</button>
                                    @else
                                        <button type="submit" name="ban" class="btn btn-warning my-2">Ban User</button>
                                    @endif
                                    <button type="submit" name="warn" class="btn btn-primary">Warn User</button>
                                    <button type="submit" name="clear_warnings" class="btn btn-info">Clear Warnings</button>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
                <div class="d-flex usercontent">
                    <div class="card mt-4 w-100">
                        <div class="card-header">User Posts</div>
                        <div class="card-body">
                            @forelse ($posts as $post)
                                <p class="mb-0"><a href="/post/{{$post->id}}">{{ $post->post_title }}</a></p>
                                <p>{{ $post->post_content }}</p>
                                <a href="{{ route('admin.usercontent.edit-post', ['user' => $user->id, 'post' => $post->id]) }}" class="btn btn-sm btn-warning">✏️</a>
                                <button class="btn btn-danger btn-sm delete-post" data-url="{{ route('posts.destroy', $post->id) }}" data-token="{{ csrf_token() }}">🗑️</button>
                                <hr>
                                @empty
                                <p>No more posts</p>
                            @endforelse
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    <div class="card mt-4 w-100">
                        <div class="card-header">User Comments</div>
                        <div class="card-body">
                            @forelse ($comments as $comment)
                                <p>{{ $comment->comment_content }}</p>
                                <a href="{{ route('admin.usercontent.edit-comment', ['user' => $user->id, 'comment' => $comment->id]) }}" class="btn btn-sm btn-warning">✏️</a>
                                <button class="btn btn-danger btn-sm delete-comment" data-url="{{ route('comments.destroy', $comment->id) }}" data-token="{{ csrf_token() }}">🗑️</button>
                                <hr>
                                @empty
                                <p>No more comments</p>
                            @endforelse
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
