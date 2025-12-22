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

document.addEventListener('DOMContentLoaded', () => {
    initCharacterCounter('#excerpt', '#excerptCount', 300);
});

function initCharacterCounter(textareaSelector, counterSelector, max) {
    const textarea = document.querySelector(textareaSelector);
    const counter = document.querySelector(counterSelector);
    if (!textarea || !counter) return;

    const updateCounter = () => {
        const length = textarea.value.length;
        counter.textContent = length;

        counter.classList.toggle('text-red-500', length >= max);
        counter.classList.toggle('font-semibold', length >= max);
    };

    textarea.addEventListener('input', updateCounter);
    updateCounter();
}