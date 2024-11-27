@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h1>{{ $post->post_title }}</h1>
        <p>{{ $post->post_content }}</p>
        <small>Posted by {{ $post->user->name }} {{ $post->user->badge ?? '' }} on {{ $post->created_at->format('M d, Y') }}</small>
        <!-- like button for the post -->
        @if (Auth::check())
            <button class="like-button btn btn-primary" data-id="{{ $post->id }}" data-type="post" type="checkbox">
                {{ auth()->user() && $post->likes->contains('liked_by', auth()->user()->id) ? 'Unlike' : 'Like' }}
            </button>
        @endif

        @if(Auth::check())
            <button type="button" class="btn btn-link report-post" data-post-id="{{ $post->id }}">Report</button>
        @endif
        <hr>
        <h2>Comments</h2>
        @foreach($post->comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p>{{ $comment->comment_content }}</p>
                    <small>Commented by {{ $comment->user->name }} {{ $comment->user->badge ?? '' }} on {{ $comment->created_at->format('M d, Y') }}</small>
                    <!-- like button for the comment -->
                    <button class="like-button btn btn-primary" data-id="{{ $comment->id }}" data-type="comment">
                        {{ auth()->user() && $comment->likes->contains('liked_by', auth()->user()->id) ? 'Unlike' : 'Like' }}
                    </button>

                    @if(Auth::check())
                        <button type="button" class="btn btn-link report-comment" data-comment-id="{{ $comment->id }}">Report</button>
                    @endif
                </div>
            </div>
            <hr>
        @endforeach
        @auth
            <form action="{{ route('post.comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="comment_content">Add a Comment</label>
                    <textarea name="comment_content" id="comment_content" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @endauth
    </div>
@endsection
