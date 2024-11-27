document.body.addEventListener('click', function(event) {
    if (event.target.matches('.delete-post')) {
        handleDelete(event, 'post');
    } else if (event.target.matches('.delete-comment')) {
        handleDelete(event, 'comment');
    }
});

function handleDelete(event, type) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(event.target.dataset.url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': event.target.dataset.token
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Deleted!',
                        `${type.charAt(0).toUpperCase() + type.slice(1)} has been deleted.`,
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        `There was an error deleting the ${type}.`,
                        'error'
                    );
                }
            });
        }
    });
}
