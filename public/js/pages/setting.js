function setupImagePreview(inputId, previewId, fileNameId) {
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
                previewContainer.classList.remove('w-28');
                previewContainer.classList.add('w-auto');
                previewContainer.innerHTML = `
                    <img 
                        src="${event.target.result}" 
                        alt="Preview" 
                        class="w-full h-full object-contain rounded-lg"
                    />
                `;
            };
            reader.readAsDataURL(file);
        } else {
            // Reset
            fileNameElement.textContent = "";
            fileNameElement.classList.remove('text-green-600', 'font-medium');
            fileNameElement.classList.add('text-slate-500');
            
            previewContainer.classList.remove('w-auto');
            previewContainer.classList.add('w-28');
            previewContainer.innerHTML = `
                <i class="fas fa-image text-white text-3xl"></i>
            `;
        }
    });
}

setupImagePreview('logo1Input', 'logo1Preview', 'logo1FileName');
setupImagePreview('logo2Input', 'logo2Preview', 'logo2FileName');
