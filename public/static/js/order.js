document.addEventListener('DOMContentLoaded', function () {
    let order_user = document.getElementById('car_user');
    let user_id = order_user.getAttribute('user_id');
    let orders_data = document.getElementById('orders_data');
    let element = "";

    url = base + '/account/orders/user/'+user_id;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            data = JSON.parse(data);
            let orders = data.orders;
            
            // Valores para la orden
            orders.forEach(order => {
                let paid_out;
                let direction = order.direction;
                if (order.paid_out == 0) {
                    paid_out = "Sin pagar";
                } else if (order.paid_out == 1) {
                    paid_out = "Pagado";
                }
                element = `<tr>
                            <td width="">${order.id}</td>
                                        <td>${order.amount_products}</td>
                                        <td>$${order.total}.00</td>
                                        <td width="300">${order.direction}</td>
                                        <td>${paid_out}</td>
                                        <td width="150">
                                            <div class="opts_order">
                                                <a href="#" onclick="direction_edit(${order.id}, '${direction}'); return false;" data-action="delete" title="Editar dirección de entrega" class="btn action-edit"><i class="fas fa-pencil"></i></a>
                                                <a href="/account/orders/user/paid_now/${order.id}" data-action="delete" title="Proceder a pagar orden" class="btn action-edit"><i class="fas fa-credit-card"></i></a>
                                                <a href="#" onclick="delete_order_user(${order.id}); return false;" data-action="delete" title="Cancelar orden" class="btn btn-danger action-delete"><i class="fas fa-times"></i></a>
                                            </div>
                                        </td>
                                    </tr>`;
                                        
                orders_data.innerHTML += element;
            });
        }
    }
});


async function direction_edit(id_order, order_direction) {
    const { value: new_direction } = await Swal.fire({
        input: 'textarea',
        inputValue: `${order_direction}`,
        inputLabel: 'Nueva dirección',
        inputPlaceholder: 'País: México, Estado: Durango, Fracc / Col: Benjamín Mendez, Calle: Marciano Arambula, #: 302, CP: 34020',
        inputAttributes: {
            'aria-label': 'Ingrese la nueva dirección a la cual se enviará el pedido'
        },
        showCancelButton: true
    })  
    if (new_direction) {
        if (new_direction.length < 20) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La dirección no puede tener menos de 20 caracteres'
            })
        } else {
            url = base + '/account/orders/user/edit/'+id_order+'/'+new_direction;
            http.open('POST', url, true);
            http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let data = this.responseText;
                    data = JSON.parse(data);
                    if(data.status == "success") {
                        // id_compra++;
                        Swal.fire({
                            icon: 'success',
                            title: 'Dirección modificada',
                            text: 'La dirección a la cual se realizará la entrega fue modificada',
                            
                        }).then(response => {
                            window.location.reload();
                        })
                    }
                    
                }
            }   
        }
    }
}


function delete_order_user(order_id) {
    Swal.fire({
        title: '¿Quieres cancelar la orden?',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: `Si`,
    }).then((result) => {
        if (result.isConfirmed) {
            url = base + '/account/orders/user/delete/'+order_id;
            http.open('GET', url, true);
            http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let data = this.responseText;
                    data = JSON.parse(data);
                    if(data.status == "success") {
                        // id_compra++;
                        Swal.fire({
                            icon: 'success',
                            title: 'Orden cancelada',
                            text: 'Tu orden fue cancelada exitosamente',
                            
                        }).then(response => {
                            window.location.reload();
                        })
                    }
                    
                }
            }
        }
    })
}
