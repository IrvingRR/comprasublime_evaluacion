@extends('master')

@section('title', 'Productos')

@section('content')
<div class="container-product mtop150">
    <h2 class="store-title">Nuestros productos</h2>
    <section>
        <div class="home_action_bar">
            <div class="row"> 
                <div class="col-md-3">
                    <div class="categories">
                        <a href="#"><i class="fas fa-list"></i> Categorias</a>
                        <ul class="shadow">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ url('/store/category/'.$category->id.'/'.$category->slug) }}">
                                        <img src="{{ url('/uploads/'.$category->file_path.'/'.$category->icono) }}" alt="">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    {!! Form::open(['url' => '/store/search']) !!}
                        <div class="input-group">
                            <i class="fas fa-search"></i>
                            {!! Form::text('search_query', null, ['class' => 'form-control', 'placeholder' => 'Hola, ¿Estas buscando algo en específico?', 'id'=>'inputBuscarProduct', 'required']) !!}
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <br>
    </section>

    {{-- PRODUCTS LIST --}}
    <section>
        <div class="products_list" id="products_list">
            @if(count($products) <= 0)
                <h3 class="respuesta_busqueda"><i class="fas fa-skull-crossbones"></i> Sin resultados...</h3>
            @else
            @foreach($products as $p)
                    <div class="product">
                        <div class="image">
                            <div class="overlay">
                                <div class="btns">
                                    <a href="{{ url('/product/'.$p->id.'/'.$p->slug) }}" title="Ver prducto"><i class="fas fa-eye"></i></a>
                                    @if(Auth::guest())
                                        <a href="#" id="carrito_1_{{$p->id}}"  onclick="Swal.fire({title: 'Oops...', text: 'Debes iniciar sesión para realizar esta acción.', icon: 'warning'}); return false" title="Agregar al carrito"><i class="fas fa-cart-plus"></i></a>
                                        <a id="favorite_1_{{$p->id}}"  onclick="Swal.fire({title: 'Oops...', text: 'Debes iniciar sesión para realizar esta acción.', icon: 'warning'}); return false" href="#" title="Agregar a favoritos"><i class="fas fa-heart"></i></a>
                                    @else
                                        <a href="#" id="carrito_1_{{$p->id}}"  onclick="add_to_car('{{ $p->id }}', '1'); return false;" title="Agregar al carrito"><i class="fas fa-cart-plus"></i></a>
                                        <a id="favorite_1_{{$p->id}}"  onclick="add_to_favorites('{{ $p->id }}', '1'); return false"; href="#" title="Agregar a favoritos"><i class="fas fa-heart"></i></a>
                                    @endif
                                </div>
                            </div>
                            <img src="{{url('/uploads/'.$p->file_path.'/'.$p->image)}}">
                        </div>
                        <a href="{{ url('/product/'.$p->id.'/'.$p->slug) }}" title="{{$p->name}}">
                            <div class="title">{{$p->name}}</div>
                            <div class="price">{{$p->currency}} {{$p->price}}</div>
                            <div class="options"></div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
</div>
@endsection