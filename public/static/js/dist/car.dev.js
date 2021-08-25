"use strict";

document.addEventListener('DOMContentLoaded', function () {
  var car_user = document.getElementById('car_user');
  var user_id = car_user.getAttribute('user_id');
  var car_products = document.getElementById('car_products');
  var car_total_container = document.getElementById('car_total_container');
  var element = "";
  var car_total_content = "";
  var total = "";
  url = base + '/md/api/car/products/' + user_id;
  http.open('GET', url, true);
  http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  http.send();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      data = JSON.parse(data);
      var products = data.products; // Valores para la orden

      var costo_total = 0;
      var cantidad_productos = products.length;
      products.forEach(function (product) {
        price = parseInt(product.price);
        id = product.id;
        amount = product.amount;
        costo_total += price;
        total.innerHTML = "$" + costo_total + ".00";
        element = "<tr>\n                                        <td width=\"\">".concat(product.id, "</td>\n                                        <td>\n                                            <a href=\"/uploads/'.").concat(product.file_path, ".'/'.").concat(product.image, ")\" data-fancybox=\"gallery\">\n                                                <img src=\"/uploads/").concat(product.file_path, "/t_").concat(product.image, "\" width=\"64\">\n                                            </a>\n                                        </td>\n                                        <td>").concat(product.code, "</td>\n                                        <td width=\"300\">").concat(product.name, "</td>\n                                        <td class=\"price_united\">$ ").concat(product.price, "</td>\n                                        <td width=\"150\">\n                                            <div class=\"opts\">\n                                                <a href=\"#\" onclick=\"delete_product_car(").concat(product.id, "); return false;\" data-action=\"delete\" title=\"Eliminar\" class=\"btn btn-danger action-delete\"><i class=\"fas fa-trash-alt\"></i></a>\n                                            </div>\n                                        </td>\n                                    </tr>");
        car_products.innerHTML += element;
      });
      car_total_content = " <h2 class=\"car_total\">Total: <span id=\"total\"> $".concat(costo_total, ".00</span></h2>\n                                    <div class=\"car_options\">\n                                        <a href=\"/account/orders/").concat(user_id, "\" class=\"btn btn-success\"><i class=\" fas fa-clipboard\"></i> Mis ordenes</a>\n                                        <a href=\"#\" onclick=\"order_now('").concat(user_id, "', '1', '").concat(cantidad_productos, "', '").concat(costo_total, "', '0'); return false\" class=\"btn btn-success\">Ordenar</a>\n                                    </div>");
      car_total_container.innerHTML = car_total_content;
    }
  };
});

function delete_product_car(id) {
  url = base + '/account/car/delete/' + id;
  http.open('GET', url, true);
  http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  http.send();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      data = JSON.parse(data);

      if (data.status == "success") {
        // Swal.fire({ title: 'Producto retirado del carrito', icon: 'success' });
        window.location.reload();
      }
    }
  };
}

function order_now(id_user, module, cantidad, total, paid_out) {
  var _ref, direction;

  return regeneratorRuntime.async(function order_now$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.next = 2;
          return regeneratorRuntime.awrap(Swal.fire({
            input: 'textarea',
            required: true,
            title: 'Ingrese una dirección',
            text: 'Indique la dirección a la cual se enviara el pedido',
            inputPlaceholder: 'Escriba su dirección aqui...',
            inputAttributes: {
              'aria-label': 'Escriba su dirección aqui'
            },
            showCancelButton: true
          }));

        case 2:
          _ref = _context.sent;
          direction = _ref.value;

          if (direction) {
            url = base + '/md/api/orders/add/' + id_user + '/' + module + '/' + total + '/' + cantidad + '/' + direction + '/' + paid_out;
            http.open('POST', url, true);
            http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.send();

            http.onreadystatechange = function () {
              if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);

                if (data.status == "success") {
                  // id_compra++;
                  Swal.fire({
                    icon: 'success',
                    title: 'Orden realizada',
                    close: false,
                    text: 'Puedes realizar el proceso de pago dentro del modulo de tus ordenes',
                    footer: "<a href=\"/account/orders/".concat(id_user, "\" class=\"enlace-orden\">Ver ordenes</a>")
                  });
                }
              }
            };
          } else {
            Swal.fire({
              icon: 'warning',
              title: 'Advertencia',
              text: 'Es necesario que ingreses una dirección a la cual se enviará el pedido'
            });
          }

          console.log("ID usuario: ".concat(id_user, " - Cantidad de productos: ").concat(cantidad, " - Total a pagar: ").concat(total, " - Direcci\xF3n ").concat(direction));

        case 6:
        case "end":
          return _context.stop();
      }
    }
  });
}

function car_delete_all(id_user) {
  url = base + '/md/api/car/delete_all/' + id;
  http.open('GET', url, true);
  http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  http.send();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      data = JSON.parse(data); // if(data.status == "success") {
      //     // Swal.fire({ title: 'Producto retirado del carrito', icon: 'success' });
      //     window.location.reload();
      // }
    }
  };
}