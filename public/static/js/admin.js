var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function () {
    var btn_search = document.getElementById('btn_search');
    var form_search = document.getElementById('form_search')
    if(btn_search) {
        btn_search.addEventListener('click', function (e) {
            e.preventDefault();
            if (form_search.style.display === 'block') {
                form_search.style.display = 'none';
            }else {
                form_search.style.display = 'block';
            }
        });
    }

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
    btn_deleted = document.getElementsByClassName('btn_deleted')
    for (i=0; i < btn_deleted.length; i ++) {
        btn_deleted[i].addEventListener('click', delete_object);
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

function delete_object(e) {
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/' + path + '/' + object + '/' + action;
    var title, text, icon;
    if (action == "delete"){
        title = "¿Estas seguro de eliminar este producto?";
        text = "Recuerda, esta acción enviará a éste elemento a la papelera o lo eliminará de forma definitiva.";
        icon = "warning";
    }
    if (action == "restore"){
        title = "¿Quieres restaurar éste producto?";
        text = "Esta acción restaurará éste producto y estará activo de nuevo en la base de datos ";
        icon = "info";
    }

    swal({
        title: title,
        text: text,
        icon: icon,
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            window.location.href = url;
        }
    });
}
