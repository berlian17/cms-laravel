// Initialize
setupCoverPreview('coverInput', 'coverFileName', 'coverPreview');
setupMultipleImagePreview('galleryInput', 'galleryFileName', 'galleryPreview');

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

function setupMultipleImagePreview(inputId, fileNameId, previewId) {
    const input = document.getElementById(inputId);
    
    if (!input) return;
    
    input.addEventListener('change', function(e) {
        const files = Array.from(this.files);
        const fileNameElement = document.getElementById(fileNameId);
        const previewContainer = document.getElementById(previewId);

        if (files.length === 0) {
            // Reset
            fileNameElement.textContent = "";
            previewContainer.className = "w-full h-72 bg-blue-500/30 rounded-xl shadow-lg mb-4 p-6";
            previewContainer.innerHTML = `
                <div class="w-full h-full flex items-center justify-center border-2 border-dashed border-blue-300 rounded-xl">
                    <div class="text-center">
                        <i class="fas fa-images text-white text-3xl mb-2"></i>
                        <p class="text-sm text-slate-500">Belum ada gambar dipilih</p>
                    </div>
                </div>
            `;
            return;
        }

        // Ubah ke grid layout
        previewContainer.className = "w-full bg-blue-500/30 rounded-xl shadow-lg mb-4 p-6";
        previewContainer.innerHTML = '<div class="grid grid-cols-1 md:grid-cols-2 gap-5"></div>';
        
        const gridContainer = previewContainer.querySelector('.grid');
        let validFiles = 0;
        const validTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        files.forEach((file, index) => {
            // Validasi tipe file
            if (!validTypes.includes(file.type)) {
                alert(`File "${file.name}" format tidak valid! Gunakan PNG, JPG, atau SVG`);
                return;
            }

            // Validasi ukuran file
            if (file.size > maxSize) {
                alert(`File "${file.name}" terlalu besar! Maksimal 2MB per file`);
                return;
            }

            validFiles++;

            // Preview gambar
            const reader = new FileReader();
            reader.onload = function(event) {
                const imageCard = document.createElement('div');
                imageCard.className = 'image-card';
                imageCard.innerHTML = `
                    <div class="relative h-72 rounded-xl shadow-lg bg-white overflow-visible group">
                        <img src="${event.target.result}" alt="preview-${index + 1}-img" class="w-full h-full object-cover rounded-xl" />

                        <button type="button" onclick="removePreviewImage(this, '${inputId}', '${previewId}')"
                            class="btn-delete-preview absolute bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110 z-50"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <p class="text-sm text-slate-700 mt-2 truncate font-medium">${file.name}</p>
                `;

                gridContainer.appendChild(imageCard);
            };
            reader.readAsDataURL(file);
        });

        // Update file count
        if (validFiles > 0) {
            fileNameElement.textContent = `${validFiles} gambar dipilih`;
            fileNameElement.classList.remove('text-slate-500');
            fileNameElement.classList.add('text-green-600', 'font-medium');
        } else {
            fileNameElement.textContent = "Tidak ada gambar valid";
            fileNameElement.classList.remove('text-slate-500', 'text-green-600');
            fileNameElement.classList.add('text-red-500', 'font-medium');
        }
    });
}

function removePreviewImage(button, inputId, previewId) {
    const imageCard = button.closest('.image-card');
    const gridContainer = imageCard.parentElement;

    imageCard.remove();

    const previewContainer = document.getElementById(previewId);
    const fileNameElement = document.getElementById('galleryFileName');

    if (gridContainer.children.length === 0) {
        previewContainer.className = "w-full h-72 bg-blue-500/30 rounded-xl shadow-lg mb-4 p-6";

        previewContainer.innerHTML = `
            <div class="w-full h-full flex items-center justify-center border-2 border-dashed border-blue-300 rounded-xl">
                <div class="text-center">
                    <i class="fas fa-images text-white text-3xl mb-2"></i>
                    <p class="text-sm text-slate-500">Belum ada gambar dipilih</p>
                </div>
            </div>
        `;

        fileNameElement.textContent = '';
        fileNameElement.classList.remove('text-green-600', 'font-medium');
        fileNameElement.classList.add('text-slate-500');

        const input = document.getElementById(inputId);
        if (input) input.value = '';
    } else {
        fileNameElement.textContent = `${gridContainer.children.length} gambar dipilih`;
    }
}

function bindBackdropClose(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    modal.addEventListener('click', function (e) {
        if (e.target === this) {
            closeModal(modalId);
        }
    });
}

bindBackdropClose('deleteGalleryModal');

function deleteGalleryModal(modalType, galleryId) {
    console.log(galleryId);
    const modal = document.getElementById(modalType);
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    const form = document.getElementById('deleteGalleryForm');
    form.action = `${form.dataset.action}/${galleryId}`;
}

function closeModal(modalType) {
    const modal = document.getElementById(modalType);
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
