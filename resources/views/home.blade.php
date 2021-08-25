@extends('master')

@section('title', 'Inicio')
{{-- Banner --}}
@section('content')
    <div class="banner">
        <div class="banner__informacion">
            <h2 class="banner__informacion__subtitulo textoAnimar"><span class="numeroSubtitulo">0%</span> de descuento</h2>
            <h1 class="banner__informacion__titulo textoAnimar">Compra seguro CompraSublime</h1>
            <p class="banner__informacion__parrafo textoAnimar">Excelentes productos con grandes descuentos.</p>
            <a href="#" class="banner__informacion__boton textoAnimar"><i class="fas fa-shopping-bag"></i> Conocer productos</a>
            <a href="#" class="banner__informacion__bajar"><i class="fas fa-arrow-down icono"></i></a>
        </div>
        <div class="banner__efecto" style="height: 100px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.98 C312.36,171.20 349.20,-49.98 538.09,132.72 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path></svg></div>
    </div>
<section>

{{-- Gallery --}}
<section>
    <h2 class="gallery__container__title">Bienvenido</h2>
    <hr class="gallery__container__regla">
    <div class="gallery-container">
        <div class="gallery__item">
            <img src="{{ url('/static/images/imagen2.jpg') }}" alt="" class="gallery__img">
            <h2 class="gallery__title">Nuevos outfits</h2>
        </div>
        <div class="gallery__item">
            <img src="{{ url('/static/images/imagen5.jpg') }}" alt="" class="gallery__img">
            <h2 class="gallery__title">Estilo</h2>
        </div>
        <div class="gallery__item">
            <img src="{{ url('/static/images/imagen12.jpg') }}" alt="" class="gallery__img">
            <h2 class="gallery__title">Accesorios</h2>
        </div>
        <div class="gallery__item">
            <img src="{{ url('/static/images/imagen15.jpg') }}" alt="" class="gallery__img">
            <h2 class="gallery__title">Casual</h2>
        </div>
    </div>
</section>

{{-- toHe/She --}}
<section>
    <div class="to">
        <div class="to__information">
            <h2>Para ellos</h2>
            <hr>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi mollitia similique reprehenderit quasi eius incidunt nostrum! Laboriosam doloremque laborum ipsa.</p>
            <a href="#">Conocer más <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="to__image">
            <div class="imageEfecto imageEfectoTop"></div>
            <img src="{{ url('/static/images/imagen11.jpg') }}" alt="">
            <div class="imageEfecto imageEfectoBottom"></div>
        </div>
    </div>
</section>

<section>
    <div class="to">
        <div class="to__image">
            <div class="imageEfecto imageEfectoTop"></div>
            <img src="{{ url('/static/images/imagen13.jpg') }}" alt="">
            <div class="imageEfecto imageEfectoBottom"></div>
        </div>

        <div class="to__information">
            <h2>Para ellas</h2>
            <hr>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi mollitia similique reprehenderit quasi eius incidunt nostrum! Laboriosam doloremque laborum ipsa.</p>
            <a href="#">Conocer más <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

{{-- Sliders --}}
  @include('componentes/slider_home');
</section>

{{-- Buscador --}}
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
                        <button class="btn btn-outline-secondary" type="submit" >Buscar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <br>
</section>

{{-- Products --}}
<section>
    <div class="products_list" id="products_list"></div>
    <div class="load_more_products">
        <a href="#" id="load_more_products" class="load_more"> Cargar más productos</a>
    </div>
</section>
<script src="{{ url('/static/js/app.js?v='.time())  }}"></script>
@endsection
