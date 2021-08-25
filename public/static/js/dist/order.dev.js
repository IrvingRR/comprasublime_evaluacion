"use strict";

document.addEventListener('DOMContentLoaded', function () {
  var order_user = document.getElementById('car_user');
  var user_id = order_user.getAttribute('user_id');
  var orders_data = document.getElementById('orders_data');
  var element = "";
  url = base + '/account/orders/user/' + user_id;
  http.open('GET', url, true);
  http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  http.send();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      data = JSON.parse(data);
      var orders = data.orders; // Valores para la orden

      orders.forEach(function (order) {
        var paid_out;
        var direction = order.direction;

        if (order.paid_out == 0) {
          paid_out = "Sin pagar";
        } else if (order.paid_out == 1) {
          paid_out = "Pagado";
        }

        element = "<tr>\n                            <td width=\"\">".concat(order.id, "</td>\n                                        <td>").concat(order.amount_products, "</td>\n                                        <td>$").concat(order.total, ".00</td>\n                                        <td width=\"300\">").concat(order.direction, "</td>\n                                        <td>").concat(paid_out, "</td>\n                                        <td width=\"150\">\n                                            <div class=\"opts_order\">\n                                                <a href=\"#\" onclick=\"direction_edit(").concat(order.id, ", '").concat(direction, "'); return false;\" data-action=\"delete\" title=\"Editar direcci\xF3n de entrega\" class=\"btn action-edit\"><i class=\"fas fa-pencil\"></i></a>\n                                                <a href=\"/account/orders/user/paid_now/").concat(order.id, "\" data-action=\"delete\" title=\"Proceder a pagar orden\" class=\"btn action-edit\"><i class=\"fas fa-credit-card\"></i></a>\n                                                <a href=\"#\" onclick=\"delete_order_user(").concat(order.id, "); return false;\" data-action=\"delete\" title=\"Cancelar orden\" class=\"btn btn-danger action-delete\"><i class=\"fas fa-times\"></i></a>\n                                            </div>\n                                        </td>\n                                    </tr>");
        orders_data.innerHTML += element;
      });
    }
  };
});

function direction_edit(id_order, order_direction) {
  var _ref, new_direction;

  return regeneratorRuntime.async(function direction_edit$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.next = 2;
          return regeneratorRuntime.awrap(Swal.fire({
            input: 'textarea',
            inputValue: "".concat(order_direction),
            inputLabel: 'Nueva dirección',
            inputPlaceholder: 'País: México, Estado: Durango, Fracc / Col: Benjamín Mendez, Calle: Marciano Arambula, #: 302, CP: 34020',
            inputAttributes: {
              'aria-label': 'Ingrese la nueva dirección a la cual se enviará el pedido'
            },
            showCancelButton: true
          }));

        case 2:
          _ref = _context.sent;
          new_direction = _ref.value;

          if (new_direction) {
            if (new_direction.length < 20) {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La dirección no puede tener menos de 20 caracteres'
              });
            } else {
              url = base + '/account/orders/user/edit/' + id_order + '/' + new_direction;
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
                      title: 'Dirección modificada',
                      text: 'La dirección a la cual se realizará la entrega fue modificada'
                    }).then(function (response) {
                      window.location.reload();
                    });
                  }
                }
              };
            }
          }

        case 5:
        case "end":
          return _context.stop();
      }
    }
  });
}

function delete_order_user(order_id) {
  Swal.fire({
    title: '¿Quieres cancelar la orden?',
    showCancelButton: true,
    cancelButtonText: 'No',
    confirmButtonText: "Si"
  }).then(function (result) {
    if (result.isConfirmed) {
      url = base + '/account/orders/user/delete/' + order_id;
      http.open('GET', url, true);
      http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
      http.send();

      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var data = this.responseText;
          data = JSON.parse(data);

          if (data.status == "success") {
            // id_compra++;
            Swal.fire({
              icon: 'success',
              title: 'Orden cancelada',
              text: 'Tu orden fue cancelada exitosamente'
            }).then(function (response) {
              window.location.reload();
            });
          }
        }
      };
    }
  });
}