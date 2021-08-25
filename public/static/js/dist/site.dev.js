"use strict";

var base = location.protocol + '//' + location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');
var http = new XMLHttpRequest();
var csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
var currency = document.getElementsByName('currency')[0].getAttribute('content');
var auth = document.getElementsByName('auth')[0].getAttribute('content');
var page = 1;
var page_section = "";
var products_list_ids_temp = [];
$(document).ready(function () {
  $('.slick-slider').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000
  });
});
document.addEventListener('DOMContentLoaded', function () {
  var slider = new MDSlider();
  var form_avatar_change = document.getElementById("form_avatar_change");
  var btn_avatar_edit = document.getElementById("btn_avatar_edit");
  var avatar_change_overlay = document.getElementById("avatar_change_overlay");
  var input_file_avatar = document.getElementById("input_file_avatar");
  var products_list = document.getElementById("products_list");
  var load_more_products = document.getElementById("load_more_products");

  if (btn_avatar_edit) {
    btn_avatar_edit.addEventListener("click", function (e) {
      e.preventDefault();
      input_file_avatar.click();
    });
  }

  if (load_more_products) {
    load_more_products.addEventListener("click", function (e) {
      e.preventDefault();
      load_products(page_section);
    });
  }

  if (input_file_avatar) {
    input_file_avatar.addEventListener("change", function () {
      var load_img = "<img src=\"".concat(base, "/static/images/loader_white.svg/\" class=\"loader__white\">");
      avatar_change_overlay.innerHTML = load_img;
      avatar_change_overlay.style.opacity = "1";
      form_avatar_change.submit();
    });
  }

  slider.show();

  if (route == 'home' || route == 'product' || route == 'store') {
    load_products('home');
  }
});

function load_products(section) {
  page_section = section;
  var url = base + '/md/api/load/products/' + page_section + '?page=' + page;
  http.open('GET', url);
  http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  http.send();

  http.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      page = page + 1;
      var data = this.responseText;
      data = JSON.parse(data);
      products_data = data.data;

      if (data.data.length == 0) {
        load_more_products.style.display = "none";
      }

      data.data.forEach(function (product, index) {
        products_list_ids_temp.push(product.id);
        var div = "";
        var opcion_favorite = "";
        var opcion_carrito = "";

        if (auth == "1") {
          opcion_favorite = "<a id=\"favorite_1_".concat(product.id, "\" onclick=\"add_to_favorites('").concat(product.id, "', '1'); return false\"; href=\"#\" title=\"Agregar a favoritos\"><i class=\"fas fa-heart\"></i></a>");
          opcion_carrito = "<a href=\"#\" id=\"carrito_1_".concat(product.id, "\" onclick=\"add_to_car('").concat(product.id, "', '1'); return false;\" title=\"Agregar al carrito\"><i class=\"fas fa-cart-plus\"></i></a>");
        } else {
          opcion_carrito = "<a id=\"carrito_1_".concat(product.id, "\" onclick=\"Swal.fire({title: 'Oops...', text: 'Debes iniciar sesi\xF3n para realizar esta acci\xF3n.', icon: 'warning'}); return false\" href=\"#\" title=\"Agregar al carrito\"><i class=\"fas fa-cart-plus\"></i></a>'");
          opcion_favorite = "<a id=\"favorite_1_".concat(product.id, "\" onclick=\"Swal.fire({title: 'Oops...', text: 'Debes iniciar sesi\xF3n para realizar esta acci\xF3n.', icon: 'warning' }); return false \" href=\"#\" title=\"Agregar a favoritos\"><i class=\"fas fa-heart\"></i></a>'");
        }

        div += "<div class=\"product\">\n                            <div class=\"image\">\n                                <div class=\"overlay\">\n                                    <div class=\"btns\">\n                                        <a href=\"".concat(base, "/product/").concat(product.id, "/").concat(product.slug, "\" title=\"Ver producto\"><i class=\"fas fa-eye\"></i></a>\n                                        ").concat(opcion_carrito, "\n                                        ").concat(opcion_favorite, "\n                                    </div>\n                                </div>\n                                <img src=\"").concat(base, "/uploads/").concat(product.file_path, "/").concat(product.image, "\">\n                            </div>\n                            <a href=\"").concat(base, "/product/").concat(product.id, "/").concat(product.slug, "\" title=\"").concat(product.name, "\">\n                                <div class=\"title\">").concat(product.name, "</div>\n                                <div class=\"price\">").concat(currency, " ").concat(product.price, "</div>\n                                <div class=\"options\"></div>\n                            </a>\n                        </div>\n                        ");
        products_list.innerHTML += div;
        return data;
      });

      if (auth == "1") {
        mark_user_favorites(products_list_ids_temp);
        products_list_ids_temp = [];
        console.log(products_list_ids_temp);
      }
    } else {// Mensaje de error
    }
  };
}

function mark_user_favorites(objects) {
  var url = base + '/md/api/load/user/favorites';
  var params = 'module=1&objects=' + objects;
  http.open('POST', url, true);
  http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  http.send(params);

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      data = JSON.parse(data);

      if (data.count > "0") {
        data.objects.forEach(function (favorite, index) {
          var _this = this;

          document.getElementById('favorite_1_' + favorite).removeAttribute('onclick');
          document.getElementById('favorite_1_' + favorite).addEventListener('click', function (e) {
            e.preventDefault();
            e["return"] = false;
            _this["return"] = false;
            Swal.fire({
              title: 'Oops...',
              text: 'Este producto ya se encuentra agregado a tus favoritos',
              icon: 'info'
            });
          });
          document.getElementById('favorite_1_' + favorite).classList.add('favorite_active');
        });
      }
    }
  };
}

function add_to_favorites(object, module) {
  url = base + '/md/api/favorites/add/' + object + '/' + module;
  http.open('POST', url, true);
  http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  http.send();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      data = JSON.parse(data);

      if (data.status == "success") {
        document.getElementById("favorite_" + module + "_" + object).removeAttribute('onclick');
        document.getElementById("favorite_" + module + "_" + object).classList.add('favorite_active');
        Swal.fire({
          title: 'Producto agregado a tus favoritos',
          icon: 'success'
        });
        mark_user_favorites(products_list_ids_temp);
      }
    }
  };
} // FUNTION ADD_TO_CAR


function add_to_car(object, module) {
  url = base + '/md/api/car/add/' + object + '/' + module;
  http.open('POST', url, true);
  http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  http.send();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      data = JSON.parse(data);

      if (data.status == "success") {
        document.getElementById("carrito_1_" + object).removeAttribute('onclick');
        document.getElementById("carrito_1_" + object).classList.add('carrito_active');
        Swal.fire({
          title: 'Producto agregado al carrito',
          icon: 'success'
        });
        mark_user_favorites(products_list_ids_temp);
      }

      console.log(data);
    }
  };
}