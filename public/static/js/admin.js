var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function () {
    if(route == "product_edit" || route == "product_add") {
        var btn_product_file_image = document.getElementById('btn_product_file_image');
        var product_file_image = document.getElementById('product_file_image');

        btn_product_file_image.addEventListener('click',function () {
            product_file_image.click();
        });
        product_file_image.addEventListener('change', function () {
            document.getElementById('form_product_gallery').submit();
        });
    }
});

$(document).ready(function () {
    editor_init('editor');
});

function editor_init(field) {
    //CKEDITOR.plugins.addExternal('codesnippet', base+'/static/libs/ckeditor/plugins/codesnippet', 'plugin.js');
    CKEDITOR.replace(field, {
       //skin: 'moono',
       //extraPlugins: 'condesnippet, ajax, xml, textmatch, autocomplete, textwatcher, emoji, panelbutton, preview, wordcount',
       toolbar: [
           {name: 'clipboard', items:[ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo']},
           {name: 'basicstyles', items:['Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockquote']},
           {name: 'document', items:['CodeSnippet', 'EmojiPanel', 'Preview', 'Source']}
       ]
    });
}
