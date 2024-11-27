@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h1>Add Content</h1>
        <form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" name="url" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="genre_id">Genre</label>
                <select name="genre_id" class="form-control" required>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cast">Cast</label>
                <input type="text" name="cast" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content_type">Content Type</label>
                <select name="content_type" class="form-control" required>
                    <option value="movie">Movie</option>
                    <option value="series">Series</option>
                    <option value="podcast">Podcast</option>
                </select>
            </div>
            <div class="form-group">
                <label for="release_date">Release Date</label>
                <input type="date" name="release_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="scheduled_for">Scheduled For (optional)</label>
                <input type="datetime-local" class="form-control" id="scheduled_for" name="scheduled_for" value="{{ old('scheduled_for', isset($content) ? $content->scheduled_for->format('Y-m-d\TH:i') : '') }}">
            </div>
            <button type="submit" class="btn btn-primary">Add Content</button>
        </form>
    </div>
@endsection
