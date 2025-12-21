function bindIconPreview(inputSelector, previewSelector) {
    const input = document.querySelector(inputSelector);
    const preview = document.querySelector(previewSelector);
    if (!input || !preview) return;

    const update = () => {
        preview.className = input.value
            ? `${input.value} text-white text-3xl`
            : 'fa-solid fa-image text-white text-3xl';
    };

    input.addEventListener('input', update);
    update();
}
