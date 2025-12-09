import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener("DOMContentLoaded", function () {
    const longDesc = document.querySelector('#long_desc_editor');

    if (longDesc) {
        ClassicEditor.create(longDesc, {
            // Hanya tampilkan toolbar yang diinginkan
            toolbar: {
                items: [
                    'bold',
                    'italic',
                    'link',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'blockQuote',
                    '|',
                    'undo',
                    'redo'
                ]
            }
        }).catch((err) => console.error(err));
    }

    // Editor full untuk yang lain
    document.querySelectorAll('.ckeditor').forEach((el) => {
        if (el.id !== 'long_desc_editor') {
            ClassicEditor
                .create(el)
                .catch(error => {
                    console.error(error);
                });
        }
    });
});
