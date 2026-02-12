document.addEventListener('DOMContentLoaded', function () {
    const addUserForm = document.getElementById('addUserForm');

    if (addUserForm) {
        addUserForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(addUserForm);

            fetch(routes.store, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Close modal
                        const modalEl = document.getElementById('addUserModal');
                        const modal = coreui.Modal.getInstance(modalEl);
                        modal.hide();

                        // Reset form
                        addUserForm.reset();

                        // Ideally, reload table or append row. For now, reload page.
                        window.location.reload();
                    } else {
                        alert('Error adding user');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    }
});
