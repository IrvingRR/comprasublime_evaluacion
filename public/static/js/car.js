document.addEventListener('DOMContentLoaded', function () {
    let car_user = document.getElementById('car_user');
    let user_id = car_user.getAttribute('user_id');
    let car_products = document.getElementById('car_products');
    let car_total_container = document.getElementById('car_total_container');
    let element = "";
    let car_total_content = "";
    let total = "";

    url = base + '/md/api/car/products/'+user_id;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            data = JSON.parse(data);
            let products = data.products;
            
            // Valores para la orden
            let costo_total = 0;
            let cantidad_productos = products.length;

            products.forEach(product => {
                price = parseInt(product.price);
                id = product.id;
                amount = product.amount;
                costo_total += price;
                total.innerHTML = "$" + costo_total + ".00";

                element = `<tr>
                                        <td width="">${product.id}</td>
                                        <td>
                                            <a href="/uploads/'.${product.file_path}.'/'.${product.image})" data-fancybox="gallery">
                                                <img src="/uploads/${product.file_path}/t_${product.image}" width="64">
                                            </a>
                                        </td>
                                        <td>${product.code}</td>
                                        <td width="300">${product.name}</td>
                                        <td class="price_united">$ ${product.price}</td>
                                        <td width="150">
                                            <div class="opts">
                                                <a href="#" onclick="delete_product_car(${product.id}); return false;" data-action="delete" title="Eliminar" class="btn btn-danger action-delete"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>`;
                car_products.innerHTML += element;
            });

            car_total_content = ` <h2 class="car_total">Total: <span id="total"> $${costo_total}.00</span></h2>
                                    <div class="car_options">
                                        <a href="/account/orders/${user_id}" class="btn btn-success"><i class=" fas fa-clipboard"></i> Mis ordenes</a>
                                        <a href="#" onclick="order_now('${user_id}', '1', '${cantidad_productos}', '${costo_total}', '0'); return false" class="btn btn-success">Ordenar</a>
                                    </div>`;
            car_total_container.innerHTML = car_total_content;
        }
    }
});

function delete_product_car(id) {
    url = base + '/account/car/delete/'+id;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            data = JSON.parse(data);
            if(data.status == "success") {
                // Swal.fire({ title: 'Producto retirado del carrito', icon: 'success' });
                window.location.reload();
            }
        }
    }
}

async function order_now(id_user, module, cantidad, total, paid_out) {
    const { value: direction } = await Swal.fire({
        input: 'textarea',
        required: true,
        title: 'Ingrese una dirección',
        text: 'Indique la dirección a la cual se enviara el pedido',
        inputPlaceholder: 'Escriba su dirección aqui...',
        inputAttributes: {
            'aria-label': 'Escriba su dirección aqui'
        },
        showCancelButton: true
    })
    if (direction) {
        url = base + '/md/api/orders/add/'+id_user+'/'+module+'/'+total+'/'+cantidad+'/'+direction+'/'+paid_out;
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
                            title: 'Orden realizada',
                            close: false,
                            text: 'Puedes realizar el proceso de pago dentro del modulo de tus ordenes',
                            footer: `<a href="/account/orders/${id_user}" class="enlace-orden">Ver ordenes</a>`
                        })
                    }
                    
                }
            }
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: 'Es necesario que ingreses una dirección a la cual se enviará el pedido'
        })
    }
    
    console.log(`ID usuario: ${id_user} - Cantidad de productos: ${cantidad} - Total a pagar: ${total} - Dirección ${direction}`);
}

function car_delete_all(id_user) {
    url = base + '/md/api/car/delete_all/'+id;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            data = JSON.parse(data);
            // if(data.status == "success") {
            //     // Swal.fire({ title: 'Producto retirado del carrito', icon: 'success' });
            //     window.location.reload();
            // }
        }
    }
}