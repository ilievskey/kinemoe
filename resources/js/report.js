document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
        if (event.target.matches('.report-post')) {
            const postId = event.target.dataset.postId;
            reportPost(postId);
        }

        if (event.target.matches('.report-comment')) {
            const commentId = event.target.dataset.commentId;
            reportComment(commentId);
        }
    });
});

function reportPost(postId) {
    Swal.fire({
        title: 'Report Post',
        input: 'textarea',
        inputLabel: 'Reason for reporting',
        inputPlaceholder: 'Type your reason here...',
        inputAttributes: {
            'aria-label': 'Type your reason here'
        },
        showCancelButton: true,
        confirmButtonText: 'Report',
        cancelButtonText: 'Cancel',
        preConfirm: (reason) => {
            if (!reason) {
                Swal.showValidationMessage('You need to provide a reason');
            }
            return reason;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/report/post/' + postId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ reason: result.value })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Reported!', 'Post has been reported.', 'success');
                } else {
                    Swal.fire('Error!', 'There was an error reporting the post.', 'error');
                }
            });
        }
    });
}

function reportComment(commentId) {
    Swal.fire({
        title: 'Report Comment',
        input: 'textarea',
        inputLabel: 'Reason for reporting',
        inputPlaceholder: 'Type your reason here...',
        inputAttributes: {
            'aria-label': 'Type your reason here'
        },
        showCancelButton: true,
        confirmButtonText: 'Report',
        cancelButtonText: 'Cancel',
        preConfirm: (reason) => {
            if (!reason) {
                Swal.showValidationMessage('You need to provide a reason');
            }
            return reason;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/report/comment/' + commentId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ reason: result.value })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Reported!', 'Comment has been reported.', 'success');
                } else {
                    Swal.fire('Error!', 'There was an error reporting the comment.', 'error');
                }
            });
        }
    });
}
