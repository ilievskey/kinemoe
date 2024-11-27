@extends('layouts.app')

@section('content')
<div class="container p-5">
    <h1>Edit Comment</h1>

    <form method="POST" action="{{ route('admin.usercontent.update-comment', ['user' => $user->id, 'comment' => $comment->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="comment_content">Content</label>
            <textarea name="comment_content" class="form-control" required>{{ $comment->comment_content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Comment</button>
    </form>
</div>
@endsection
