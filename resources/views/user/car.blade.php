@extends('master')

@section('title', 'Mi carrito')

@section('content')
    <div class="container-fluid mtop100 favorites__container">
        <div class="panel">
            <div class="header favorites__header">
                <h2 class="title"><i class=" fas fa-shopping-bag"></i>Mi Carrito</h2><br>
                <span class="favorites__amount">{{ count($car_products) }}</span>
            </div>

            <div class="inside mtop50">
                <table class="table table-striped">
                  @if(count($products) <= 0)
                    <tr>
                      <td><i class="fas fa-shopping-bag"></i> Tu carrito esta vacio</td>
                    </tr>
                  @else
                  <thead>
                    <tr>
                      <td>ID</td>
                      <td></td>
                      <td>Código</td>
                      <td>Nombre</td>
                      <td>Precio</td>
                      <td>Acciones</td>
                    </tr>
                  </thead>
                  <tbody id='car_products'>
                  </tbody>
                  <div class="mtop50 car_total_container" id="car_total_container">
                  </div>
                  @endif
                </table>
              </div>

        </div>
    </div>
@endsection