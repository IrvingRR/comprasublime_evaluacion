@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
<li class="breadcrumb-item">
  <a href="{{ url('/admin/categories/0') }}"><i class=" fas fa-folders"></i>Categorias</a>
</li>
@if ($cat->parent != "0")
  <li class="breadcrumb-item">
    <a href="{{ url('/admin/categories/'.$cat->parent.'/subs') }}"><i class=" fas fa-folders"></i>{{ $cat->getParent->name }}</a>
  </li>

  <li class="breadcrumb-item">
    <a href="{{ url('/admin/categories/'.$cat->id.'/edit') }}"><i class=" fas fa-folders"></i>Editando {{ $cat->name }}</a>
  </li>
@endif
<li class="breadcrumb-item">
  <a href="{{ url('/admin/categories/'.$cat->id.'/edit') }}"><i class=" fas fa-folders"></i>Editando {{ $cat->name }}</a>
</li>
@endsection

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="panel shadow">
          <div class="header">
            <h2 class="title"><i class="fas fa-pencil"></i>Editar categoria</h2>
          </div>
          <div class="inside">
            {!! Form::open(['url' => '/admin/category/'.$cat->id.'/edit', 'files' => true]) !!}
            <label for="name">Nombre:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
              </div>
              {!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
            </div>    

            <label for="icon" class="mtop16">Icono:</label>
            <div class="custom-file">
              {!! Form::file('icon', ['class' => 'form-control', 'id' => 'formFile', 'accept'=>'image/']) !!}
            </div>

            <label for="name" class="mtop16">Orden:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
              </div>
              {!! Form::number('order', $cat->order, ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      @if(!is_null($cat->icono)) 
      <div class="col-md-3">
        <div class="panel shadow">
          <div class="header">
            <h2 class="title"><i class="fas fa-boxes"></i>Icono</h2>
          </div>
          <div class="inside">
            <img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icono) }}" alt="" class="img-fluid">
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
