{{-- PLANTILLA PARA MOSTRAR AL PROFESOR --}}

@extends('emails.master')

@section('content')
<p>Hola: <strong>Ulises Romero</strong> </p>
<p>Este correo electrónico le permitira verificar la vlidez de su correo electrónico.</p>
<p>Para coninuar haga clic en el siguiente botón que valida la existencia de su correo.:</p>
<p><a href="{{ url('/reset?email='.'ulises@gmail.com') }}" style="display:inline-block; padding:10px 20px; color:#fff; background: #22BFD5; text-decoration: none; border-radius: 5px;">Verificar</a></p>
@stop