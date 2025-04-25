import Quill from 'quill';

const initQuill = () => {
    const quillElements = document.querySelectorAll('.quill-editor');
    
    quillElements.forEach(element => {
        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            ['link', 'image', 'video', 'formula'],
            [{ 'header': 1 }, { 'header': 2 }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'direction': 'rtl' }],
            [{ 'size': ['small', false, 'large', 'huge'] }],
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['clean']
        ];

        const quill = new Quill(element, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow',
            placeholder: 'Ketik konten Anda di sini...',
        });

        const inputId = element.getAttribute('data-input-id');
        if (inputId) {
            const hiddenInput = document.getElementById(inputId);
            
            // Set initial content from hidden input field
            if (hiddenInput && hiddenInput.value) {
                quill.root.innerHTML = hiddenInput.value;
            }

            // Sync content from Quill editor to hidden input field on text change
            quill.on('text-change', () => {
                hiddenInput.value = quill.root.innerHTML;
            });
        }
    });
};

document.addEventListener('DOMContentLoaded', initQuill);
