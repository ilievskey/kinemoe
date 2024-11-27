@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h3>Highlighted Posts</h3>
        <div class="list-group mb-4">
            @foreach($highlightedPosts as $post)
                <a href="{{ route('post.show', $post->id) }}" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">{{ $post->post_title }}</h5>
                    <p class="mb-1">{{ Str::limit($post->post_content, 100) }}</p>
                    <small>Posted by {{ $post->user->name }} {{ $post->user->badge ?? '' }} on {{ $post->created_at->format('M d, Y') }}</small>
                    @if(Auth::user() && Auth::user()->isAdmin())
                    <form action="{{ route('posts.highlight', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-link">
                            {{ $post->is_highlighted ? 'Unhighlight' : 'Highlight' }}
                        </button>
                    </form>
                @endif
                </a>
            @endforeach
        </div>

        <div class="d-flex mb-3">
            <h3>Posts</h3>
            <a class="btn btn-primary ms-auto" href="{{ route('posts.create') }}">
                {{ __('Create Post') }}
            </a>
        </div>
        <div class="list-group">
            @foreach($posts as $post)
                <a href="{{ route('post.show', $post->id) }}" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">{{ $post->post_title }}</h5>
                    <p class="mb-1">{{ Str::limit($post->post_content, 100) }}</p>
                    <small>Posted by {{ $post->user->name }} {{ $post->user->badge ?? '' }} on {{ $post->created_at->format('M d, Y') }}</small>
                    @if(Auth::user() && Auth::user()->isAdmin())
                    <form action="{{ route('posts.highlight', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-link">
                            {{ $post->is_highlighted ? 'Unhighlight' : 'Highlight' }}
                        </button>
                    </form>
                    
                @endif
                </a>
                @endforeach
                {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
