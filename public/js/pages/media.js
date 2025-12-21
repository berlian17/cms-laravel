function setupCoverPreview(inputId, fileNameId, previewId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    
    input.addEventListener('change', function(e) {
        const file = this.files[0];
        const fileNameElement = document.getElementById(fileNameId);
        const previewContainer = document.getElementById(previewId);

        if (file) {
            // Validasi tipe file
            const validTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'];
            if (!validTypes.includes(file.type)) {
                alert('Format file tidak valid! Gunakan PNG, JPG, atau SVG');
                this.value = '';
                return;
            }

            // Validasi ukuran file (Max 2MB)
            const maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Ukuran file terlalu besar! Maksimal 2MB');
                this.value = '';
                return;
            }

            // Tampilkan nama file
            fileNameElement.textContent = "File dipilih: " + file.name;
            fileNameElement.classList.remove('text-slate-500');
            fileNameElement.classList.add('text-green-600', 'font-medium');

            // Preview gambar
            const reader = new FileReader();
            reader.onload = function(event) {
                previewContainer.classList.remove('w-full', 'bg-blue-500/30', 'p-6');
                previewContainer.innerHTML = `
                    <img src="${event.target.result}" alt="cover-image" class="w-auto h-72 object-cover rounded-xl" />
                `;
            };
            reader.readAsDataURL(file);
        } else {
            // Reset
            fileNameElement.textContent = "";
            fileNameElement.classList.remove('text-green-600', 'font-medium');
            fileNameElement.classList.add('text-slate-500');
            
            previewContainer.classList.add('w-full', 'bg-blue-500/30', 'p-6');
            previewContainer.innerHTML = `
                <i class="fas fa-image text-white text-3xl"></i>
            `;
        }
    });
}

// Initialize Tom Select for all elements with class 'tom-select
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.tom-select').forEach(el => {
        new TomSelect(el, {
            plugins: ['remove_button'],
            placeholder: 'Pilih atau buat kata kunci baru',
            persist: false,
            create: true
        });
    });
});

function bindBackdropClose(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    modal.addEventListener('click', function (e) {
        if (e.target === this) {
            closeModal(modalId);
        }
    });
}

function deleteTagModal(modalType, tagId) {
    const modal = document.getElementById(modalType);
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    const form = document.getElementById('deleteTagForm');
    form.action = `${form.dataset.action}/${tagId}`;
}

function closeModal(modalType) {
    const modal = document.getElementById(modalType);
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
