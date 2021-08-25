@extends('emails.master')

@section('content')
<p>Hola: <strong>{{ $name }} {{ $lastname }}</strong> </p>
<p>Esta es la nueva contraseña para tu cuenta en nuestra plataforma.</p>
<p><h3>{{ $password }}</h3></p>
<p>Para iniciar sesión haga clic en el siguiente botón</p>
<p><a href="{{ url('/login') }}" style="display:inline-block; padding:10px 20px; color:#fff; background: #22BFD5; text-decoration: none; border-radius: 5px;">Resetear mi contraseña</a></p>
<p>Si el botón anterior no funciona, copie y pegue en su navegador el siguiente enlace</p>
<p>{{ url('/login') }}</p>
@stop
