document.addEventListener('DOMContentLoaded', function () {
    const editUserModal = document.getElementById('editUserModal');
    const editUserForm = document.getElementById('editUserForm');

    // Open Modal and Fetch Data
    document.querySelectorAll('.edit-user-btn').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            const url = routes.edit.replace(':id', userId);

            // Fetch user data
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editUserId').value = data.id;
                    document.getElementById('editFirstName').value = data.first_name;
                    document.getElementById('editLastName').value = data.last_name;
                    document.getElementById('editEmail').value = data.email;
                    document.getElementById('editUserType').value = data.user_type;

                    // Show Modal
                    const modal = new coreui.Modal(editUserModal);
                    modal.show();
                })
                .catch(error => console.error('Error:', error));
        });
    });

    // Handle Update
    if (editUserForm) {
        editUserForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const userId = document.getElementById('editUserId').value;
            const url = routes.update.replace(':id', userId);
            const formData = new FormData(editUserForm);
            // Append _method PUT for Laravel
            formData.append('_method', 'PUT');

            fetch(url, {
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
                        const modal = coreui.Modal.getInstance(editUserModal);
                        modal.hide();
                        window.location.reload();
                    } else {
                        alert('Error updating user');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    }
});
