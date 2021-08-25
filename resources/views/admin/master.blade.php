<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ Config::get('cms.name')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <link rel="stylesheet" href="{{ url('/static/css/preloader.css?v='.time())  }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/static/css/admin.css?v='.time())  }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">
    <script src="{{url('/static/js/preloader.js?v='.time())}}" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
  </head>
  <body>
    <div class="container__preloader" id="container__preloader">
      <div class="preloader" id="preloader"></div>
  </div>
      <div class="wrapper">
        <div class="col1">@include('admin.sidebar')</div>
        <div class="col2">
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

          <nav class="navbar navbar-expand-lg shadow">
            <div class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/admin') }}"><i class="fas fa-home"></i>Dashboard</a>
                </li>
              </ul>
            </div>
          </nav>
          <div class="page">
            <div class="container-fluid">
              <nav aria-label="breadcrumb shadow nav-breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{url('/admin')}}"><i class=" fas fa-home"></i>Dashboard</a>
                  </li>
                  @section('breadcrumb')
                  @show
                </ol>
              </nav>
            </div>
            @section('content')
            @show
          </div>
        </div>
      </div>
      <script src="{{url('/static/libs/ckeditor/ckeditor.js')}}" charset="utf-8"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>  
      <script src="{{url('/static/js/admin.js?v='.time())}}" charset="utf-8"></script>
  </body>
</html>
