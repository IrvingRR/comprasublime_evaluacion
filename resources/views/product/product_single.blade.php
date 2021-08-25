@extends('master')

@section('title', $product->name);
    
@section('content')
    <div class="product_single">
            <div class="row">
                {{-- Featureds Img & Gallery --}}
                <div class="col-md-4">
                    <div class="slick-slider">
                        <div>
                            <a href="{{ url('uploads/'.$product->file_path.'
                                /'.$product->image) }}" data-fancybox="gallery">
                                <img class="img-fluid" src="{{ url('uploads/'.$product->file_path.'
                                /'.$product->image) }}" alt="">
                            </a>
                        </div>
                        @if(count($product->getGallery) > 0)
                            @foreach($product->getGallery as $gallery)
                                <div>
                                    <a href="{{ url('uploads/'.$gallery->file_path.'
                                        /t_'.$gallery->file_name) }}" data-fancybox="gallery">
                                        <img class="img-fluid" src="{{ url('uploads/'.$gallery->file_path.'
                                        /t_'.$gallery->file_name) }}" alt="">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>  

                <div class="col-md-8 product__info">
                    <h2 class="product__title">{{$product->name}}</h2>
                    <strong class="product__price">{{ Config::get('cms.currency')}}{{$product->price}}</strong>
                    <a class="product__etiqueta product__addCar" onclick="add_to_car({{$product->id}} ,'1')" href="#"><i class="fas fa-shopping-bag"></i> Agregar al carrito</a>
                    <h3 class="product__details">Detalles del producto</h3>

                    @if ($product->indiscount != 0) 
                        <span class="product__indiscount product__etiqueta">{{$product->discount}}% de descuento</span>
                    @endif
                    <p class="product__content">{{$product->content}}</p>
                </div>
            </div>
    </div>
    <section>
        <div class="products_list" id="products_list"></div>
        {{-- <div class="load_more_products">
            <a href="#" id="load_more_products" class="load_more"> Cargar más productos</a>
        </div> --}}
    </section>
@endsection