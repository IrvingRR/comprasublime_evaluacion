@extends('admin.master')

@section('title', 'Ordenes')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/orders') }}"><i class=" fas fa-clipboard"></i>Ordenes</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class=" fas fa-clipboard"></i>Ordenes</h2>
            </div>
            <div class="inside">
                <table class="table table-striped">
                    @if(count($orders) <= 0) <tr>
                        <td><i class="fas fa-clipboard"></i> No han realizado ninguna orden</td>
                        </tr>
                        @else
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Cantidad de productos</td>
                                <td>Total a pagar</td>
                                <td>Dirección</td>
                                <td>Estado de pago</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)

                            <tr>
                                <td width="">{{$order->id}}</td>
                                <td>{{$order->amount_products}}</td>
                                <td>${{$order->total}}.00</td>
                                <td width="400">{{$order->direction}}</td>
                                @if ($order->paid_out == 0)
                                <td>Sin pagar</td>
                                @else
                                <td>Pagado</td>
                                @endif

                                <td width="150">
                                    <div class="opts_order">
                                        <a href="{{ url('/admin/order/'.$order->id.'/delete') }}" data-action="delete"
                                            title="Eliminar orden" class="btn btn-danger action-delete"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
            </div>
            @endif
            </table>
        </div>
    </div>
</div>
</div>
{{-- <script src="{{url('/static/js/order.js?v='.time())}}" charset="utf-8"></script> --}}
@endsection
