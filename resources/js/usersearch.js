document.addEventListener('DOMContentLoaded', function () {

    document.body.addEventListener('input', function(event) {
        if (event.target.matches('#user-search')) {
            let query = event.target.value;
            fetch('/admin/search-users?q=' + query)
                .then(response => response.json())
                .then(data => {
                    let results = document.getElementById('user-results');
                    results.innerHTML = '';
                    data.forEach(user => {
                        let li = document.createElement('li');
                        li.className = 'list-group-item p-2 m-4 border rounded-3';

                        let img = document.createElement('img');
                        img.className = 'rounded-circle object-fit-cover ms-2 me-5';
                        img.src = user.profile_picture ? `/storage/${user.profile_picture}` : 'storage/profile_pictures/blank.png';
                        img.style.width = '75px';
                        img.style.height = '75px';

                        let editLink = document.createElement('a');
                        editLink.className = 'fw-bold text-decoration-none';
                        editLink.href = `/admin/users/${user.id}/edit`;
                        editLink.textContent = `${user.name}`;

                        li.appendChild(img);
                        li.appendChild(editLink);

                        results.appendChild(li);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    });

    document.body.addEventListener('click', function(event) {
        if (event.target.matches('#delete-user')) {
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
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': event.target.dataset.token
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.href = "/dashboard";
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the user.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    });
});
