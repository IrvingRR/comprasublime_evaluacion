let base = location.protocol+'//'+location.host;
let route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
const currency = document.getElementsByName('currency')[0].getAttribute('content');
const auth = document.getElementsByName('auth')[0].getAttribute('content');
let page = 1;
let page_section = "";
let products_list_ids_temp = [];

$(document).ready(function() {
    $('.slick-slider').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000
    });
});

document.addEventListener('DOMContentLoaded', function(){
    let slider = new MDSlider;
    
    let form_avatar_change = document.getElementById("form_avatar_change");
    let btn_avatar_edit = document.getElementById("btn_avatar_edit");
    let avatar_change_overlay = document.getElementById("avatar_change_overlay");
    let input_file_avatar = document.getElementById("input_file_avatar");
    let products_list = document.getElementById("products_list");
    let load_more_products = document.getElementById("load_more_products");

    if (btn_avatar_edit) {
        btn_avatar_edit.addEventListener("click", (e) => {
            e.preventDefault();
            input_file_avatar.click();
        });
    }

    if (load_more_products) {
        load_more_products.addEventListener("click", (e) => {
            e.preventDefault();
            load_products(page_section);
        });
    }

    if(input_file_avatar) {
        input_file_avatar.addEventListener("change", function(){
            let load_img = `<img src="${base}/static/images/loader_white.svg/" class="loader__white">`;
            avatar_change_overlay.innerHTML = load_img;
            avatar_change_overlay.style.opacity="1";
            form_avatar_change.submit();
        });
    }
    slider.show();

    if(route == 'home' || route == 'product' || route == 'store') {
        load_products('home');
    }
});

function load_products(section) {
    page_section = section;
    let url = base + '/md/api/load/products/'+page_section+'?page='+page;
    http.open('GET', url);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            page = page + 1;
            let data = this.responseText;
            data = JSON.parse(data);
            products_data = data.data;

            if (data.data.length == 0) {
                load_more_products.style.display = "none";
            }
            
            data.data.forEach(function (product, index) {
                products_list_ids_temp.push(product.id);
                let div = "";
                let opcion_favorite = "";
                let opcion_carrito = "";
                if (auth == "1") {
                    opcion_favorite = `<a id="favorite_1_${product.id}" onclick="add_to_favorites('${product.id}', '1'); return false"; href="#" title="Agregar a favoritos"><i class="fas fa-heart"></i></a>`
                    opcion_carrito = `<a href="#" id="carrito_1_${product.id}" onclick="add_to_car('${product.id}', '1'); return false;" title="Agregar al carrito"><i class="fas fa-cart-plus"></i></a>`
                } else {
                    opcion_carrito = `<a id="carrito_1_${product.id}" onclick="Swal.fire({title: 'Oops...', text: 'Debes iniciar sesión para realizar esta acción.', icon: 'warning'}); return false" href="#" title="Agregar al carrito"><i class="fas fa-cart-plus"></i></a>'`;
                    opcion_favorite = `<a id="favorite_1_${product.id}" onclick="Swal.fire({title: 'Oops...', text: 'Debes iniciar sesión para realizar esta acción.', icon: 'warning' }); return false " href="#" title="Agregar a favoritos"><i class="fas fa-heart"></i></a>'`;
                }
                div += `<div class="product">
                            <div class="image">
                                <div class="overlay">
                                    <div class="btns">
                                        <a href="${base}/product/${product.id}/${product.slug}" title="Ver producto"><i class="fas fa-eye"></i></a>
                                        ${opcion_carrito}
                                        ${opcion_favorite}
                                    </div>
                                </div>
                                <img src="${base}/uploads/${product.file_path}/${product.image}">
                            </div>
                            <a href="${base}/product/${product.id}/${product.slug}" title="${product.name}">
                                <div class="title">${product.name}</div>
                                <div class="price">${currency} ${product.price}</div>
                                <div class="options"></div>
                            </a>
                        </div>
                        `;

                products_list.innerHTML += div;
                return data;
            });

            if (auth == "1") {
                mark_user_favorites(products_list_ids_temp);
                products_list_ids_temp = [];
                console.log(products_list_ids_temp);
            }
            
            
        }else {
            // Mensaje de error
        }
    }
}

function mark_user_favorites(objects) {
    let url = base + '/md/api/load/user/favorites';
    let params = 'module=1&objects='+objects;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            data = JSON.parse(data);
            if(data.count > "0") {
                data.objects.forEach(function (favorite, index) {
                    document.getElementById('favorite_1_' + favorite).removeAttribute('onclick');
                    document.getElementById('favorite_1_' + favorite).addEventListener('click', (e) => {
                        e.preventDefault();
                        e.return = false;
                        this.return = false;
                        Swal.fire({title: 'Oops...', text:'Este producto ya se encuentra agregado a tus favoritos', icon: 'info' });
                    })
                    document.getElementById('favorite_1_' + favorite).classList.add('favorite_active');
                });
            }
        }
    }
}

function add_to_favorites(object, module) {
    url = base + '/md/api/favorites/add/'+object+'/'+module;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            data = JSON.parse(data);
            if(data.status == "success") {
                document.getElementById("favorite_"+module+"_"+object).removeAttribute('onclick');
                document.getElementById("favorite_"+module+"_"+object).classList.add('favorite_active');
                Swal.fire({title: 'Producto agregado a tus favoritos', icon: 'success' });
                mark_user_favorites(products_list_ids_temp);
            }
        }
    }
}

// FUNTION ADD_TO_CAR

function add_to_car(object, module) {
    url = base+'/md/api/car/add/'+object+'/'+module;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            data = JSON.parse(data);
            if(data.status == "success") {
                document.getElementById("carrito_1_"+object).removeAttribute('onclick');
                document.getElementById("carrito_1_"+object).classList.add('carrito_active');
                Swal.fire({title: 'Producto agregado al carrito', icon: 'success' });
                mark_user_favorites(products_list_ids_temp);
            }
            console.log(data);
        }
    } 
}
