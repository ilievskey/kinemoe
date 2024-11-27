@extends('layouts.app')

@section('content')
<div class="container p-5">
    <h1>Edit Content</h1>
    <form action="{{ route('admin.content.update', $content->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if ($content->image_path)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->title }}" width="100">
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $content->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $content->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="url" name="url" class="form-control" value="{{ $content->url }}" required>
        </div>
        <div class="form-group">
            <label for="genre_id">Genre</label>
            <select name="genre_id" class="form-control" required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $content->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->genre_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cast">Cast</label>
            <input type="text" name="cast" class="form-control" value="{{ $content->cast }}" required>
        </div>
        <div class="form-group">
            <label for="content_type">Content Type</label>
            <select name="content_type" class="form-control" required>
                <option value="movie" {{ $content->content_type == 'movie' ? 'selected' : '' }}>Movie</option>
                <option value="series" {{ $content->content_type == 'series' ? 'selected' : '' }}>Series</option>
                <option value="podcast" {{ $content->content_type == 'podcast' ? 'selected' : '' }}>Podcast</option>
            </select>
        </div>
        <div class="form-group">
            <label for="release_date">Release Date</label>
            <input type="date" name="release_date" class="form-control" value="{{ $content->release_date }}" required>
        </div>
        <div class="form-group">
            <label for="scheduled_for">Scheduled For (optional)</label>
            <input type="datetime-local" class="form-control" id="scheduled_for" name="scheduled_for" value="{{ old('scheduled_for', isset($content) ? $content->scheduled_for : '') }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Content</button>
    </form>
</div>
@endsection
