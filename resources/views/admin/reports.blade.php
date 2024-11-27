<div class="container p-5">
    <h1>Reports</h1>
    <hr>
    <div class="list-group">
        @forelse($reports as $report)
            <div class="list-group-item">
                <p><strong>Reported by:</strong> {{ $report->user->name }}</p>
                <p><strong>Reason:</strong> {{ $report->reason }}</p>
                @if($report->post)
                    <p><strong>Post:</strong> <a href="/post/{{$report->post_id}}">{{ $report->post->post_title }}</a></p>
                @elseif($report->comment)
                    <p><strong>Comment:</strong> {{ $report->comment->comment_content }}</p>
                @endif
                <form action="{{ route('admin.reports.delete', $report->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger my-3">Delete Content</button>
                </form>
                <form action="{{ route('admin.reports.dismiss', $report->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Dismiss Report</button>
                </form>
            </div>
            @empty
            <p class="p-5 text-center">There are no reports!</p>
            @endforelse
        {{-- changed from foreach to forelse --}}
    </div>
</div>
