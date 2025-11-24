import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Link from '@tiptap/extension-link';
import Placeholder from '@tiptap/extension-placeholder';
import Image from '@tiptap/extension-image';

document.addEventListener('DOMContentLoaded', () => {
    const editorElement = document.querySelector('#tiptap-editor');
    const contentInput = document.querySelector('#content-input');

    if (editorElement && contentInput) {
        const editor = new Editor({
            element: editorElement,
            extensions: [
                StarterKit,
                Link.configure({
                    openOnClick: false,
                }),
                Placeholder.configure({
                    placeholder: 'Write something amazing...',
                }),
                Image,
            ],
            content: contentInput.value, // Initialize with existing content
            editorProps: {
                attributes: {
                    class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto focus:outline-none min-h-[300px] p-4 border border-gray-200 rounded-md dark:border-gray-700 dark:text-gray-300',
                },
            },
            onUpdate: ({ editor }) => {
                contentInput.value = editor.getHTML();
            },
        });
    }
});
