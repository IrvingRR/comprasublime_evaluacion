@extends('emails.master')

@section('content')
<p>Hola: <strong>{{ $name }} {{ $lastname }}</strong> </p>
<p>Este correo electrónico le permitira reestablecer la contraseña de su cuenta en nuestra plataforma</p>
<p>Para coninuar haga clic en el siguiente botón e ingrese el siguiente código: <h3>{{ $code }}</h3> </p>
<p><a href="{{ url('/reset?email='.$email) }}" style="display:inline-block; padding:10px 20px; color:#fff; background: #22BFD5; text-decoration: none; border-radius: 5px;">Resetear mi contraseña</a></p>
<p>Si el botón anterior no funciona, copie y pegue en su navegador el siguiente enlace</p>
<p>{{ url('/reset?email='.$email) }}</p>
@stop
