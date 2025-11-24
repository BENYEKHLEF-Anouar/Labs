import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Placeholder from '@tiptap/extension-placeholder';

document.addEventListener('DOMContentLoaded', () => {
    const editorElement = document.querySelector('#editor');
    const contentInput = document.querySelector('#content');

    if (editorElement && contentInput) {
        const editor = new Editor({
            element: editorElement,
            extensions: [
                StarterKit,
                Image,
                Link.configure({
                    openOnClick: false,
                    autolink: true,
                    linkOnPaste: true,
                }),
                Placeholder.configure({
                    placeholder: 'Write something amazing...',
                }),
            ],
            content: contentInput.value || '<p>Start writing your article here...</p>',
            onUpdate: ({ editor }) => {
                contentInput.value = editor.getHTML();
            },
        });
    }
});
