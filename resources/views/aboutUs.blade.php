@extends('master')

@section('title', 'Nosotros')

@section('content')
<div class="aboutUs_banner">
    <h2 class="aboutUs_title">Acerca de nosotros</h2>
    <div class="banner__efecto" style="height: 100px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.98 C312.36,171.20 349.20,-49.98 538.09,132.72 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path></svg></div>
</div>
<div class="aboutUs_info mtop100">
    <div class="aboutUs_info_text">
        <h2 class="aboutUs_info_text_title">CompraSublime</h2>
        <hr class="regla">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minus corrupti consequuntur voluptatem dolor eos modi sunt eligendi, perferendis dignissimos velit numquam sequi provident, quis tenetur alias, doloribus error fugiat fuga porro exercitationem beatae possimus?.
        <br><br>
        Obcaecati hic molestias, earum deserunt reiciendis est, recusandae temporibus quisquam dolorem minima quibusdam voluptatum beatae! Facilis, nisi recusandae! Aspernatur atque minima earum quia dolore. Officiis quis animi illum enim itaque, distinctio reprehenderit esse culpa aspernatur qui quia inventore consequuntur! Earum modi nobis sunt dolores id impedit eos, odit }</p>
    </div>

    <div class="aboutUs_info_images">
        <div class="imagen1 imagen">
            <img src="{{ url('/static/images/imagen6.jpg') }}" alt="">
        </div>
        <div class="imagen2 imagen">
            <img src="{{ url('/static/images/imagen11.jpg') }}" alt="">
        </div>
    </div>
</div>

@endsection
