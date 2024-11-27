@extends('layouts.app')

@section('content')
<div class="container p-5">
    
    <div><a href="{{ route('home') }}" class="btn btn-light fs-5 my-4">🔙 Back</a></div>
    <div id="showContent" class="d-flex gap-5 mb-4">
        <div class="mb-4 me-4 text-center">
            @if ($content->image_path)
            <img class="rounded-4" src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->title }}" width="300">
            @else
            <p>No Image</p>
            @endif
        </div>
        
        <div>
            <h1 class="text-capitalize">{{ $content->title }}</h1>
            <p><strong>Description:</strong> {{ $content->description }}</p>
            <p class="text-capitalize"><strong>Genre:</strong> {{ $content->genre->genre_name }}</p>
            <p class="text-capitalize"><strong>Type:</strong> {{ ucfirst($content->content_type) }}</p>
            <p class="text-capitalize"><strong>Cast:</strong> {{ $content->cast }}</p>
            <p class="text-capitalize"><strong>Release Date:</strong> {{ $content->release_date }}</p>
        </div>
    </div>
    <div><a href="{{ $content->url }}" class="btn btn-success fs-5">🎞️ Watch</a></div>

</div>
@endsection

