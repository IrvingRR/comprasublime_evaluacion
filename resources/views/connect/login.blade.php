@extends('connect.master') <!-- Extendemos o utilizamos la estructura escrita dentro del archivo "master.blade.php" -->

@section('title', 'Login')
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
            <h1>Ingresar</h1>
            <a href="{{ url('/') }}">
                <!-- <img  src="{{ url('/static/images/logo.jpg') }}" alt="Logotipo"> -->
                <h2 class="logo">S</h2>
            </a>
        </header>
        <div class="inside">
            {!! Form::open (['url' => '/login']) !!}
            <label for="email">Correo electrónico:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-at"></i></div>
                    </div>
                    {!! Form::email('email', null, ['class' => 'form-control'] ) !!}
                </div>

                <label for="email" class="mtop16">Contraseña:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    {!! Form::password('password', ['class' => 'form-control'] ) !!}
                </div>
                {!! Form::submit('Ingresar', ['class' => 'btn btn-success mtop16' ]) !!}
            {!! Form::close() !!}

            <div class="footer mtop16">
                <a href="{{ url('/register') }}">¿Aún no tienes una cuenta?, crea una</a>
                <a href="{{ url('/recover') }}">¿No recuerdas tu contraseña?</a>
            </div>
        </div>
    </div>
</div>
@stop
