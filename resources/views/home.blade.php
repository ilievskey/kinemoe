@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <h1>New Releases</h1>
        <div class="container">
            <div class="content-scroll-container">
                @foreach ($contentsLatest as $content)
                    <div class="content-item">
                        <a href="{{ route('content.show', $content->id) }}">
                            @if ($content->image_path)
                                <img class="rounded-4" src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->title }}" width="200">
                            @else
                                No Image
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row justify-content-center pt-5">
        <h1>Latest Movies</h1>
        <div class="container">
            <div class="content-scroll-container">
                @foreach ($contentsMovies as $content)
                    <div class="content-item">
                        <a href="{{ route('content.show', $content->id) }}">
                            @if ($content->image_path)
                                <img class="rounded-4" src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->title }}" width="200">
                            @else
                                No Image
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row justify-content-center pt-5">
        <h1>Latest Series</h1>
        <div class="container">
            <div class="content-scroll-container">
                @foreach ($contentsSeries as $content)
                    <div class="content-item">
                        <a href="{{ route('content.show', $content->id) }}">
                            @if ($content->image_path)
                                <img class="rounded-4" src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->title }}" width="200">
                            @else
                                No Image
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row justify-content-center pt-5">
        <h1>Latest Podcasts</h1>
        <div class="container">
            <div class="content-scroll-container">
                @foreach ($contentsPodcasts as $content)
                    <div class="content-item">
                        <a href="{{ route('content.show', $content->id) }}">
                            @if ($content->image_path)
                                <img class="rounded-4" src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->title }}" width="200">
                            @else
                                No Image
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
