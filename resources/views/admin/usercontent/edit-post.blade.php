@extends('layouts.app')

@section('content')
<div class="container p-5">
    <h1>Edit Post</h1>

    <form method="POST" action="{{ route('admin.usercontent.update-post', ['user' => $user->id, 'post' => $post->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="post_title">Title</label>
            <input type="text" name="post_title" class="form-control" value="{{ $post->post_title }}" required>
        </div>

        <div class="form-group">
            <label for="post_content">Content</label>
            <textarea name="post_content" class="form-control" required>{{ $post->post_content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
