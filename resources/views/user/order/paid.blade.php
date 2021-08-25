@extends('master')

@section('title', 'Proceso de pago')

@section('content')
<div class="container-fluid mtop100 favorites__container">
    <div class="panel">
        <div class="header favorites__header">
            <h2 class="title"><i class=" fas fa-credit-card"></i>Proceso de pago</h2><br>
        </div>
        <div class="inside mtop50">
            <div class="paid_now_container">
                <div class="paid_now_header_user flex paid_now_content">
                    <h3>Información del usuario</h3>
                    <p class="paid_now_value_p">Nombre: {{ $user->name }} {{ $user->lastname }}</p>
                    <p class="paid_now_value_p">Apellido: {{ $user->email }}</p>
                    <p class="paid_now_value_p">Número de teléfono: {{ $user->phone }}</p>
                </div>
                <div class="paid_now_header paid_now_content">
                    <div class="paid_now_header_title paid_now_content flex">
                        <h3>Productos</h3>
                        <span class="paid_now_value">{{ $order->amount_products }}</span>
                    </div>
                    <table class="table table-striped table_paid_now">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Código</td>
                                <td>Nombre</td>
                                <td>Precio</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <img src="{{url('/uploads/'.$product->file_path.'/'.$product->image)}}" width="64">
                                </td>
                                <td>{{$product->code}}</td>
                                <td width="300">{{$product->name}}</td>
                                <td class="price_united">${{$product->price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paid_now_header_values flex paid_now_content">
                    <h3>Total</h3>
                    <span>${{ $order->total }}.00</span>
                </div>

                <div class="paid_now_main paid_now_content">
                    <h3>Dirección de entrega</h3>
                    <p>{{ $order->direction }}</p>
                </div>

                <div class="paid_now_footer flex paid_now_content">
                    <h3>Pagar</h3>
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
<script src="{{url('/static/js/order.js?v='.time())}}" charset="utf-8"></script>
<script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({

        // Set up the transaction
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ $order->total }}'
                    }
                }]
            });
        },

        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Show a success message to the buyer
                alert('Transación completada por ' + {{ $order->name }} {{ $order->lastname }} + '!');
            });
        }


    }).render('#paypal-button-container');
</script>
@endsection