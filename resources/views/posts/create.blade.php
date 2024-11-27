@extends('layouts.app')

@section('content')

    <div class="container p-5">
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
        <h1>Create Post</h1>
        <form action="{{ route('post.store') }}" method="POST">
            @csrf
            <div class="form-group my-3">
                <label for="post_title">Post title</label>
                <input type="text" name="post_title" id="post_title" class="form-control">
            </div>
            <div class="form-group my-3">
                <label for="post_content">Post cotent</label>
                <textarea name="post_content" id="post_content" rows="5" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
