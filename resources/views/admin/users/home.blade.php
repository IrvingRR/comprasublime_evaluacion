@extends('admin.master')

@section('title', 'Usuarios')

@section('breadcrumb')
<li class="breadcrumb-item">
  <a href="{{ url('/admin/users') }}"><i class=" fas fa-user-friends"></i>Usuarios</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="panel shadow">
      <div class="header">
          <h2 class="title"><i class=" fas fa-user-friends"></i>Usuarios</h2>
      </div>
      <div class="inside">
        <div class="row">
          <div class="col-md-2 offset-md-10"> 
            <div class="dropdown">
              <button style="width:100%" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-filter"></i> Filtrar
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <a class="dropdown-item" href="{{ url('/admin/users/all') }}"><i class="fas fa-stream"></i> Todos</a>
                <a class="dropdown-item" href="{{ url('/admin/users/0') }}"><i class="fas fa-user-slash"></i> No verificados</a>
                <a class="dropdown-item" href="{{ url('/admin/users/1') }}"><i class="fas fa-user-check"></i> Verificados</a>
                <a class="dropdown-item" href="{{ url('/admin/users/100') }}"><i class="fas fa-heart-broken"></i> Baneados / Suspendidos</a>
              </div>
            </div>
          </div>
        </div>
        <table class="table top16">
          @if(count($users) <= 0) <tr>
            <td><i class="fas fa-user-friends"></i> No hay usuarios registrados</td>
            </tr>
          @else
          <thead>
            <tr>
              <td>ID</td>
              <td>Imagen</td>
              <td>Nombre</td>
              <td>Apellido</td>
              <td>Email</td>
              <td>Estado</td>
              <td>Rol</td>
              <td></td>
            </tr> 
            <tbody>
              @foreach($users as $user)
              {{-- <tr> --}}
                <td>{{ $user->id }}</td>
                <td width="64"> 
                  @if(is_null($user->avatar))
                    <img src="{{ url('/static/images/avatar_default.png') }}" class="avatar img-fluid rounded-circle">
                  @else
                    <img src="{{ url('/uploads_users/'.$user->id.'/'.$user->avatar) }}" class="avatar img-fluid rounded-circle">
                  @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ getUserStatusArray(null,$user->status) }}</td>
                  <td>{{ getRoleUserArray(null,$user->role) }}</td>
                <td>
                  <div class="opts">
                    @if(kvfj(Auth::user()->permissions, 'user_edit'))
                    <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" title="Editar"><i class="fas fa-pencil"></i></a>
                    @endif
                    @if(kvfj(Auth::user()->permissions, 'user_permissions'))
                    <a href="{{ url('/admin/user/'.$user->id.'/permissions') }}" title="Permisos de usuario"><i class="fas fa-cog"></i></a>
                    @endif
                  </div>
                </td>
              </tr>
              @endforeach
              <tr>
                <td colspan="7">{!! $users->render() !!}</td>
              </tr>
            </tbody>
          </thead>
          @endif
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
