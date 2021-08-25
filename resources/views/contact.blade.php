@extends('master')

@section('title', 'Contacto')

@section('content')
<div class="contact_banner">
    <div class="formulario_containt">
        <form action="" class="form_contact" id="form_contact">
            <h2 class="form_title">Habla con nosotros</h2>
            <input type="text" class="input_contact" name="name" placeholder="Nombre" id="contact_name" required>
            <input type="text" class="input_contact" name="lastname" placeholder="Apellido" id="contact_lastname" required>
            <input type="email" class="input_contact" name="email" placeholder="Correo electrónico" id="contact_email" required>
            <textarea name="mensaje" id="contact_mensaje" class="input_mensaje" placeholder="Mensaje"></textarea>
            <input type="submit" class="input_contact_btn" value="Enviar" id="btn_enviar_contact">
        </form>
    </div>
</div>
<script src="{{url('/static/js/contact.js?v='.time())}}" charset="utf-8"></script>
@endsection