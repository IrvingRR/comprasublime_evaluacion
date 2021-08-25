@extends('master')

@section('title', 'Inicio')

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
        <div class="products_list" id="products_list"></div>
        <div class="load_more_products">
            <a href="#" id="load_more_products" class="load_more"> Cargar más productos</a>
        </div>
    </section>
</div>
@endsection