@extends('admin.master')

@section('title', 'Sliders')

@section('breadcrumb')
<li class="breadcrumb-item">
  <a href="{{ url('/admin/sliders') }}"><i class=" fas fa-images"></i>Sliders</a>
</li>
@endsection

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          @if(kvfj(Auth::user()->permissions, 'slider_add'))
          <div class="panel shadow">
              <div class="header">
                <h2 class="title"><i class="fas fa-plus"></i>Agregar slider</h2>
              </div>
              <div class="inside">
                {!! Form::open(['url' => '/admin/slider/add', 'files' => true]) !!}
                <label for="name">Nombre:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                  </div>
                  {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
    
                <label for="section" class="mtop16">Visible:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                  </div>
                  {!! Form::select('visible', ['0' => 'No visible', '1' => 'Visible'], 1 , ['class' => 'form-select']) !!}
                </div>
    
                  <label for="icon" class="mtop16">Imagen destacada:</label>
                  <div class="custom-file">
                    {!! Form::file('img', ['class' => 'form-control', 'id' => 'formFile', 'accept'=>'image/']) !!}
                  </div>

                  <label for="name" class="mtop16">Contenido:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5]) !!}
                  </div>

                  <label for="name" class="mtop16">Orden de aparición:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                    </div>
                    {!! Form::number('sorder', null, ['class' => 'form-control', 'min' => '0']) !!}
                  </div>
    
                {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
    
                {!! Form::close() !!}
              </div>
            </div>
          @endif
      </div>
      <div class="col-md-8">
        <div class="panel shadow">
          <div class="header">
            <h2 class="title"><i class="fas fa-plus"></i>Agregar slider</h2>
          </div>
          <div class="inside">
            <table class="table">
              <thead>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
                @foreach ($sliders as $slider)
                    <tr>
                      <td width="230">
                        <img src="{{url('/uploads/'.$slider->file_path.'/'.$slider->file_name)}}" class="img-fluid img-slider">
                      </td>
                      <td>
                        <div class="slider_content">
                          <h1>{{ $slider->name }}</h1>
                          {!! html_entity_decode($slider->content) !!}
                        </div>
                      </td>
                      <td>
                        <div class="opts">
                          @if(kvfj(Auth::user()->permissions, 'slider_edit'))
                          <a href="{{ url('/admin/slider/'.$slider->id.'/edit') }}" title="Editar"><i class="fas fa-pencil"></i></a>
                          @endif
                          @if(kvfj(Auth::user()->permissions, 'slider_delete'))
                            <a href="#" data-path="admin/slider" data-action="delete" data-object="{{$slider->id}}" title="Eliminar" class="btn-deleted"><i class="fas fa-trash-alt"></i></a>
                          @endif
                        </div>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
      </div>
      </div>
    </div>
@endsection