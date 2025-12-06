document.getElementById('logoInput').addEventListener('change', function() {
    const file = this.files[0];
    const fileNameElement = document.getElementById('fileName');

    if (file) {
        fileNameElement.textContent = "File dipilih: " + file.name;
    } else {
        fileNameElement.textContent = "";
    }
});
