@extends('master')

@section('title', 'Favoritos')

@section('content')
    <div class="container-fluid mtop100 favorites__container">
        <div class="panel shadow">
            <div class="header favorites__header">
                <h2 class="title"><i class=" fas fa-heart"></i>Mi lista de favoritos</h2><br>
                <span class="favorites__amount">{{ count($favorites) }}</span>
            </div>
        </div>
    </div>
    <div class="products_list" id="products_list">
        @if (count($favorites) <= 0)
            <h3 class="respuesta_busqueda"><i class="fas fa-heart-broke"></i> Aún no tiene productos agregados como favoritos...</h3>
        @else
                @foreach($products as $p) 
                    <div class="product">
                        <div class="image">
                            <div class="overlay">
                                <div class="btns">
                                    <a href="{{ url('/product/'.$p->object_id.'/'.$p->slug) }}" title="Ver prducto"><i class="fas fa-eye"></i></a>
                                    <a href="" title="Agregar al carrito"><i class="fas fa-cart-plus"></i></a>
                                    <a href="{{ url('/account/favorites/delete/'.$p->id) }}" title="Retirar de mis favoritos"><i class="fas fa-heart-broken"></i></a>
                                </div>
                                </div>
                                <img src="{{url('/uploads/'.$p->file_path.'/'.$p->image)}}">
                            </div>
                            <a href="{{ url('/product/'.$p->id.'/'.$p->slug) }}" title="{{$p->name}}">
                                <div class="title">{{$p->name}}</div>
                                <div class="price">${{$p->price}}</div>
                                <div class="category">${{$p->cat->name}}</div>
                                <div class="options"></div>
                            </a>
                    </div>
            @endforeach
        @endif
    </div>
@endsection