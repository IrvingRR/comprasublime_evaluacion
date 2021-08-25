@extends('master')

@section('title', 'Mis ordenes')

@section('content')
<div class="container-fluid mtop100 favorites__container">
    <div class="panel">
        <div class="header favorites__header">
            <h2 class="title"><i class=" fas fa-clipboard"></i>Mis ordenes</h2><br>
            <span class="favorites__amount">{{ count($orders) }}</span>
        </div>

        <div class="inside mtop50">
            <table class="table table-striped">
              @if(count($orders) <= 0)
                <tr>
                  <td><i class="fas fa-clipboard"></i> No has realizado ninguna orden</td>
                </tr>
              @else
              <thead>
                <tr>
                  <td>ID</td>
                  <td>Cantidad de productos</td>
                  <td>Total a pagar</td>
                  <td>Mi dirección</td>
                  <td>Estado de pago</td>
                  <td>Acciones</td>
                </tr>
              </thead>
              <tbody id='orders_data'>
              </tbody>
              </div>
              @endif
            </table>
          </div>
    </div>
</div>
<script src="{{url('/static/js/order.js?v='.time())}}" charset="utf-8"></script>
@endsection