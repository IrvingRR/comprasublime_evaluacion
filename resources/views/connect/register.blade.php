@extends('connect.master') <!-- Extendemos o utilizamos la estructura escrita dentro del archivo "master.blade.php" -->

@section('title', 'Crear cuenta')
@section('content')
<div class="contenedor">
  @if(Session::has('message'))
        <div class="container">
          <div class="alert alert-{{ Session::get('typealert') }}" style="display:none;">
              {{ Session::get('message') }}
              @if ($errors->any())
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              @endif
              <script>
                $('.alert').slideDown();
                setTimeout(function(){ $('.alert').slideUp(); }, 10000);
              </script>
          </div>
        </div>
        @endif
    <div class="box box_login">
        <header class="header">
            <h1>Crear cuenta</h1>
            <a href="{{ url('/') }}">
                <!-- <img  src="{{ url('/static/images/logo.jpg') }}" alt="Logotipo"> -->
                <h2 class="logo">S</h2>
            </a>
        </header>
        <div class="inside">
            {!! Form::open (['url' => '/register']) !!}
            <label for="email" class="mtop16">Correo electrónico:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-at"></i></div>
                    </div>
                    {!! Form::email('email', null, ['class' => 'form-control', 'required'] ) !!}
                </div>

                <label for="name" class="mtop16">Nombre:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-user"></i></div>
                    </div>
                    {!! Form::text('name', null, ['class' => 'form-control', 'required'] ) !!}
                </div>

                <label for="lastname" class="mtop16">Apellido:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-user-circle"></i></div>
                    </div>
                    {!! Form::text('lastname', null, ['class' => 'form-control', 'required'] ) !!}
                </div>

                <label for="password" class="mtop16">Contraseña:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    {!! Form::password('password', ['class' => 'form-control', 'required'] ) !!}
                </div>

                <label for="cpassword" class="mtop16">Confirmar contraseña:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    {!! Form::password('cpassword', ['class' => 'form-control', 'required'] ) !!}
                </div>
                {!! Form::submit('Registrarse', ['class' => 'btn btn-success mtop16' ]) !!}
            {!! Form::close() !!}

            <div class="footer mtop16">
                <a href="{{ url('/login') }}">¿Ya tienes una cuenta?, ingresar ahora</a>
            </div>
        </div>
    </div>
</div>
@stop
