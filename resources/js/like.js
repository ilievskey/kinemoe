document.addEventListener('DOMContentLoaded', function () {
    function toggleLike(itemId, isPost) {
        const data = isPost ? { post_id: itemId } : { comment_id: itemId };

        fetch('/toggle-like', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                const button = document.querySelector(`button[data-id="${itemId}"][data-type="${isPost ? 'post' : 'comment'}"]`);
                if (button) {
                    button.textContent = button.textContent === 'Like' ? 'Unlike' : 'Like';
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function attachLikeButtons() {
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-id');
                const isPost = this.getAttribute('data-type') === 'post';
                toggleLike(itemId, isPost);
            });
        });
        // console.log('Like buttons attached');
    }

    attachLikeButtons();
});
