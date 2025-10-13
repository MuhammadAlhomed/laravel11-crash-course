import './bootstrap';
import Quill from 'quill';
import 'quill/dist/quill.core.css'
import * as feather from 'feather-icons';


const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],
    ['link', 'image', 'video', 'formula'],

    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'list': 'check' }],
    [{ 'script': 'sub' }, { 'script': 'super' }],      // superscript/subscript
    [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],                         // text direction

    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],

    ['clean']                                         // remove formatting button
];

const editorElement = document.querySelector('#editor')
if(editorElement)
{
    const quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions,
        },
        theme: 'snow',
    });
}


document.addEventListener('DOMContentLoaded',() => {
    console.log('Loaded');
    feather.replace()
})
