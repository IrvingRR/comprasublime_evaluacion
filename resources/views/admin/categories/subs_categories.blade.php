@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
<li class="breadcrumb-item">
  <a href="{{ url('/admin/categories/0') }}"><i class=" fas fa-folders"></i> Categorías: {{ $category->name }}</a>
</li>

<li class="breadcrumb-item">
    <a href="#"><i class=" fas fa-folders"></i> Subcategorías: {{ $category->name }}</a>
  </li>
@endsection

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      
      
      <div class="col-md-12">
        <div class="panel shadow">
          <div class="header">
            <h2 class="title"><i class=" fas fa-folders"></i> Subcategorías de <strong>{{ $category->name }}</strong></h2>
          </div>
          <div class="inside">
            <table class="table mtop16">
              <thead>
                <tr>
                  <td width="50"></td>
                  <td>Nombre</td>
                  <td width="200"></td>
                </tr>
              </thead>
              <tbody>
                @foreach($category->getSubCategories as $cat)
                <tr>
                  <td>
                    @if(!is_null($cat->icono))
                    <img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icono) }}" alt="" class="img-fluid">
                    @endif
                  </td>
                  <td>{{$cat->name}}</td>
                  <td>
                    <div class="opts">
                      @if(kvfj(Auth::user()->permissions, 'categories_edit'))
                      <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" title="Editar"><i class="fas fa-pencil"></i></a>
                      @endif
                      @if(kvfj(Auth::user()->permissions, 'categories_delete'))
                      <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" title="Eliminar" ><i class="fas fa-trash-alt"></i></a>
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
</div>
@endsection
