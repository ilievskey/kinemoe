<div class="container p-5">
    <div class="d-flex">
        <h1>Content Management</h1>
        <div class="ms-auto"><a href="{{ route('admin.content.create-content') }}" class="btn btn-primary">Add Content</a></div>
    </div>
    <hr>
    <table id="content-table" class="table mt-3">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th class="no-mobile">Description</th>
                <th class="no-mobile">Genre</th>
                <th class="no-mobile">Type</th>
                <th class="no-mobile">Release Date</th>
                <th class="no-mobile">Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contents as $content)
                <tr>
                    <td>
                        <a href="{{ $content->url }}" target="_blank">
                            @if ($content->image_path)
                                <img src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->title }}" width="100">
                            @else
                                No Image
                            @endif
                        </a>
                    </td>
                    <td>{{ $content->title }}</td>
                    <td class="no-mobile">{{ $content->description }}</td>
                    <td class="no-mobile">{{ $content->genre->genre_name }}</td>
                    <td class="no-mobile">{{ ucfirst($content->content_type) }}</td>
                    <td class="no-mobile">{{ $content->release_date }}</td>
                    <td class="no-mobile">
                        @if ($content->scheduled_for)
                            Scheduled for {{ $content->scheduled_for }}
                        @else
                            Active
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.content.edit', $content->id) }}" class="btn btn-warning my-3">Edit</a>
                        <form action="{{ route('admin.content.delete', $content->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" data-delete-content="{{ $content->id }}" data-url="{{ route('admin.content.delete', $content->id) }}">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>