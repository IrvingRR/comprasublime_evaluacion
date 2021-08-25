<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit = no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <meta name="currency" content="{{ Config::get('cms.currency') }}">
    <meta name="auth" content="{{ Auth::check() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="{{ url('/static/css/preloader.css?v='.time())  }}">
    <link rel="stylesheet" href="{{ url('/static/css/style.css?v='.time())  }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{url('/static/js/preloader.js?v='.time())}}" charset="utf-8"></script>
    <script src="{{url('/static/js/mdslider.js?v='.time())}}" charset="utf-8"></script>
    <script src="{{url('/static/js/car.js?v='.time())}}" charset="utf-8"></script>
    <script src="{{url('/static/js/site.js?v='.time())}}" charset="utf-8"></script>

    <title>@yield('title') - {{ Config::get('cms.name')}}</title>
</head>
<body>
<div class="container__preloader" id="container__preloader">
    <div class="preloader" id="preloader"></div>
</div>
    <nav class="navbar navbar-expand-lg shadow menu">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <h1 class="logo" title="CompraSublime">S</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigationMain" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navigationMain">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home"></i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/store') }}"><i class="fas fa-store-alt"></i> Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/aboutUs') }}"><i class="fas fa-user-friends"></i> Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}"><i class="fas fa-envelope-open"></i> Contacto</a>
                    </li>
                    @if(Auth::guest())
                        <li class="nav-item link-acc">
                            <a class="nav-link btn" href="{{ url('/login') }}"><i class="fas fa-user-circle"></i> Mi cuenta</a>
                        </li>
                        <li class="nav-item link-acc">
                            <a class="nav-link btn" href="{{ url('/register') }}"><i class="fas fa-user-plus"></i> Registrarse</a>
                        </li>
                        @else    
                        <li class="nav-item link-acc dropdown">
                            <a class="nav-link btn link-user dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"  href="#">
                                @if(is_null(Auth::user()->avatar)) 
                                    <img class="user_avatar" src="{{ url('/static/images/avatar_default.png') }}"> 
                                @else
                                    <img class="user_avatar" src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}">
                                @endif 
                                Hola: {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu">
                                @if (Auth::user()->role == "1")
                                <li><a class="dropdown-item" href="{{url('/admin') }}"><i class="fas fa-chart-bar"></i> Administración</a></li>
                                <li><hr class="dropdown-divider"></li>
                                @endif
                                <li><a class="dropdown-item" href="{{url('/account/favorites/'.Auth::id()) }}"><i class="fas fa-heart"></i> Favoritos</a></li>
                                <li><a class="dropdown-item" href="{{ url('/account/car/'.Auth::id()) }}"><i class="fas fa-shopping-bag"></i> <span class="carnumber" id="car_user" user_id="{{ Auth::id() }}">Mi carrito</span></a></li>
                                <li><a class="dropdown-item" href="{{url('/account/edit') }}"><i class="fas fa-address-card"></i> Editar inforamción</a></li>
                                <li><a class="dropdown-item" href="{{url('/logout') }}"><i class="fas fa-sign-out"></i> Salir</a></li>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if(Session::has('message'))
    <div class="container-fluid">
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

    <div class="wrapper">
        <div class="contain">
            @yield('content')
        </div>
    </div>
</body>
</html>