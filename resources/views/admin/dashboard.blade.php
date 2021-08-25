@extends('admin.master')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">
  @if(kvfj(Auth::user()->permissions, 'dashboard_small_stats'))
  <div class="panel shadow">
    <div class="header">
        <h2 class="title"><i class=" fas fa-chart-bar"></i>Estadísticas ráspidas</h2><br>
      </div>
  </div>

  <div class="row mtop16">
    <div class="col-md-3">
      <div class="panel shadow">
        <div class="header">
          <h2 class="title"><i class=" fas fa-user-friends"></i>Usuarios registrados</h2>
        </div>
        <div class="inside inside_small_stats">
          <div class="big_count">{{ $users }}</div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="panel shadow">
        <div class="header">
          <h2 class="title"><i class=" fas fa-boxes"></i>Productos listados</h2>
        </div>
        <div class="inside inside_small_stats">
          <div class="big_count">{{ $products }}</div>
        </div>
      </div>
    </div>
    @if(kvfj(Auth::user()->permissions, 'dashboard_sell_today'))
    <div class="col-md-3">
      <div class="panel shadow">
        <div class="header">
          <h2 class="title"><i class=" fas fa-clipboard"></i>Ordenes</h2>
        </div>
        <div class="inside inside_small_stats">
          <div class="big_count">{{ $orders }}</div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="panel shadow">
        <div class="header">
          <h2 class="title"><i class=" fas fa-envelope"></i>Mensajes recibidos</h2>
        </div>
        <div class="inside inside_small_stats">
          <div class="big_count">{{ $messages }}</div>
        </div>
      </div>
    </div>
    @endif
  </div>
  @endif
</div> 

@endsection
