function bindBackdropClose(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    modal.addEventListener('click', function (e) {
        if (e.target === this) {
            closeModal(modalId);
        }
    });
}

bindBackdropClose('addModal');
bindBackdropClose('editModal');

function openModal(modalType, userId) {
    const modal = document.getElementById(modalType);
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    if (modalType === 'editModal') {
        fetch(`/users/${userId}/edit`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('edit_name').value = data.name;
                document.getElementById('edit_email').value = data.email;
                document.getElementById('edit_status').value = data.status;

                const form = document.getElementById('editForm');
                form.action = `${form.dataset.action}/${userId}`;
            });
    }
}

function closeModal(modalType) {
    const modal = document.getElementById(modalType);
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function togglePassword(button) {
    const wrapper = button.closest('.relative');
    const input = wrapper.querySelector('.password-input');
    const icon = button.querySelector('i');

    if (!input || !icon) return;

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
