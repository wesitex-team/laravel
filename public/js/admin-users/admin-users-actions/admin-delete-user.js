document.addEventListener('DOMContentLoaded', function () {
    const deleteUserModal = document.getElementById('deleteUserModal');
    let deleteUserId = null;

    // Open Delete Modal
    document.querySelectorAll('.delete-user-btn').forEach(button => {
        button.addEventListener('click', function () {
            deleteUserId = this.getAttribute('data-id');
            const modal = new coreui.Modal(deleteUserModal);
            modal.show();
        });
    });

    // Confirm Delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (deleteUserId) {
            const url = routes.destroy.replace(':id', deleteUserId);

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = coreui.Modal.getInstance(deleteUserModal);
                        modal.hide();
                        window.location.reload();
                    } else {
                        alert('Error deleting user');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
});
