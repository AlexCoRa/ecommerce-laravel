var base = location.protocol+'//'+location.host;

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
