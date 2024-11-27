<div class="container p-5" data-posts-count="{{ $postsCount }}" data-comments-count="{{ $commentsCount }}" data-likes-count="{{ $likesCount }}">
    <div class="row justify-content-center">
        <div id="dash-home-content" class="d-flex gap-5">
            <div class="card mx-auto shadow-lg rounded-3 p-4 m-2 my-4">
                <canvas id="statsChart" class="mx-auto"></canvas>
            </div>

            <div class="card mx-auto shadow-lg rounded-3 p-4 m-2 my-4">
                <h2 class="text-center">Latest registered users</h2>
                <ul class="list-group">
                    @foreach ($latestUsers as $user)
                        <li class="list-group-item fs-4">{{$user->name}}</li>
                    @endforeach
                </ul>
            </div>

            <div class="card mx-auto shadow-lg rounded-3 p-4 m-2 my-4">
                <h2 class="text-center">Newest reports</h2>
                <ul class="list-group" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width:14em; ">
                    @forelse ($latestReports as $report)
                    @if ($report->comment)
                        <li class="list-group-item fs-4">{{ $report->comment->comment_content }}</li>
                    @elseif ($report->post)
                        <li class="list-group-item fs-4"><a href="/post/{{$report->post_id}}">{{ $report->post->post_content }}</a></li>
                    @else
                        <li class="list-group-item fs-4">No report</li>
                    @endif
                    @empty
                    <li class="text-center">No reports found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>