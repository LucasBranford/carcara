import 'bootstrap';
import 'admin-lte';

import { ClassicEditor, Essentials, Paragraph, Bold, Italic, Font } from './ckeditor/ckeditor5.js';
import './ckeditor/ckeditor5.css';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.ckeditor').forEach(textarea => {
        ClassicEditor
        .create(textarea, {
            licenseKey: 'GPL',
            plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        })
        .catch(error => {
            console.error(error);
        });
    });
});//
