const base = location.protocol+'//'+location.host;
const route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function () {
    var slider = new MDSlider();
    var form_avatar_change = document.getElementById('form_avatar_change');
    var btn_avatar_edit = document.getElementById('btn_avatar_edit');
    var input_file_avatar = document.getElementById('input_file_avatar');
    var avatar_change_overlay = document.getElementById('avatar_change_overlay');
    var products_list = document.getElementById('products_list');

    if (btn_avatar_edit) {
        btn_avatar_edit.addEventListener("click", function (e) {
            e.preventDefault();
            input_file_avatar.click();
        })
    }
    if (input_file_avatar) {
        input_file_avatar.addEventListener("change", function () {
            var load_img = '<img src="'+base+'/static/images/loader_white.svg" />';
            avatar_change_overlay.innerHTML = load_img;
            avatar_change_overlay.style.display = 'flex';
            form_avatar_change.submit();
        })
    }
    slider.show();

    if(route == "home") {
        load_products('home');
    }
});

function load_products(section) {
    var url = base + '/md/api/load/products/'+section;
   http.open('GET', url, true);
   http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
   http.send();

   http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            data = JSON.parse(data);
            console.log(data.data);
            data.data.forEach(function (product, index) {
                var div = "";
                div += "<div class=\"product\">";
                    div += "<div class=\"image\">";
                        div += "<div class='overlay'>";
                            div += "<div class='btns'>";
                                div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\"><i class=\"fas fa-eye\"></i></a>";
                                div += "<a href=''><i class=\"fas fa-cart-plus\"></i></a>";
                                div += "<a href=''><i class=\"fas fa-heart\"></i></a>";
                            div += "</div>";
                        div += "</div>";
                        div += "<img src=\""+base+"/uploads/"+product.file_path+"/t_"+product.image+"\">";
                    div += "</div>";
                    div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\">";
                        div += "<div class=\"title\">"+product.name+"</div>";
                        div += "<div class=\"price\">$"+product.price+"</div>";
                        div += "<div class=\"options\"></div>";
                    div += "</a>";
                div += "</div>"
                products_list.innerHTML += div;
            });
        }else {
            //mensaje de error
        }
   }
}
