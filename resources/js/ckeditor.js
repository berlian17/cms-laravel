function initCKEditor() {
    const editors = document.querySelectorAll('.ckeditor');
    
    if (!editors || editors.length === 0) {
        return;
    }

    editors.forEach((el) => {
        if (!el || el.classList.contains('ck-editor__editable')) {
            return;
        }

        const folder = document.getElementById('CKEditorFolder')?.value || 'general';

        const {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Underline,
            Strikethrough,
            Font,
            Paragraph,
            Heading,
            Link,
            List,
            BlockQuote,
            Image,
            ImageCaption,
            ImageToolbar,
            ImageUpload,
            ImageResize,
            ImageStyle,
            Table,
            TableToolbar,
            Alignment,
            Indent,
            HorizontalLine,
            CodeBlock,
            RemoveFormat,
            Code,
            Subscript,
            Superscript
        } = CKEDITOR;

        ClassicEditor
            .create(el, {
                plugins: [
                    Essentials,
                    Bold,
                    Italic,
                    Underline,
                    Strikethrough,
                    Code,
                    Subscript,
                    Superscript,
                    Font,
                    Paragraph,
                    Heading,
                    Link,
                    List,
                    BlockQuote,
                    Image,
                    ImageCaption,
                    ImageStyle,
                    ImageToolbar,
                    ImageUpload,
                    ImageResize,
                    Table,
                    TableToolbar,
                    Alignment,
                    Indent,
                    HorizontalLine,
                    CodeBlock,
                    RemoveFormat
                ],
                toolbar: {
                    items: [
                        'undo',
                        'redo',
                        '|',
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        '|',
                        'alignment',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'link',
                        'uploadImage',
                        'insertTable',
                        'blockQuote'
                    ],
                    shouldNotGroupWhenFull: true
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                image: {
                    toolbar: [
                        'toggleImageCaption',
                        '|',
                        'imageStyle:inline',
                        'imageStyle:wrapText',
                        'imageStyle:breakText',
                        'imageStyle:side',
                        '|',
                        'imageTextAlternative',
                        'linkImage'
                    ],
                    resizeOptions: [
                        {
                            name: 'resizeImage:original',
                            label: 'Original',
                            value: null
                        },
                        {
                            name: 'resizeImage:25',
                            label: '25%',
                            value: '25'
                        },
                        {
                            name: 'resizeImage:50',
                            label: '50%',
                            value: '50'
                        },
                        {
                            name: 'resizeImage:75',
                            label: '75%',
                            value: '75'
                        }
                    ],
                    styles: {
                        options: [
                            'inline',
                            'alignLeft',
                            'alignRight',
                            'alignCenter',
                            'alignBlockLeft',
                            'alignBlockRight',
                            'block',
                            'side'
                        ]
                    }
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                }
            })
            .then(editor => {
                // Custom Upload Adapter
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return {
                        upload: () => {
                            return loader.file.then(file => new Promise((resolve, reject) => {
                                const formData = new FormData();
                                formData.append('upload', file);
                                formData.append('folder', folder);

                                fetch('/upload/ckeditor', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.url) {
                                        resolve({ default: data.url });
                                    } else {
                                        reject(data.error?.message || 'Upload failed');
                                    }
                                })
                                .catch(error => reject(error));
                            }));
                        },
                        abort: () => {}
                    };
                };

                console.log('CKEditor initialized successfully');
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });
    });
}

// Inisialisasi saat DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCKEditor);
} else {
    initCKEditor();
}
