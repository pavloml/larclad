ClassicEditor = require('@ckeditor/ckeditor5-build-classic');

window.createPostEditor = (node) => {
    ClassicEditor
        .create(node, {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote','|', 'undo', 'redo']
        } )
        .catch(error => {
            console.log( error );
        } );

}
