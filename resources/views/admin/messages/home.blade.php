@extends('admin.master')

@section('title', 'Mensajes')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/messages') }}"><i class=" fas fa-envelope"></i>Mensajes</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class=" fas fa-envelope"></i>Mensajes</h2>
            </div>
            <div class="inside">
                <table class="table table-striped">
                    @if(count($messages) <= 0) <tr>
                        <td><i class="fas fa-envelope"></i> Sin mensajes</td>
                        </tr>
                    @else
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Apellido</td>
                                <td>Correo electrónico</td>
                                <td>mensaje</td>
                                <td>Fecha de recibido</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                            <tr>
                                <td width="">{{$message->id}}</td>
                                <td>{{$message->name}}</td>
                                <td>{{$message->lastname}}</td>
                                <td width="200">{{$message->email}}</td>
                                <td width="200">{{$message->message}}</td>
                                <td>{{$message->created_at}}</td>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'messages_delete'))
                                        <a href="{{ url('/admin/message/'.$message->id.'/delete') }}" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
            </div>
            @endif
            </table>
        </div>
    </div>
</div>
</div>
{{-- <script src="{{url('/static/js/order.js?v='.time())}}" charset="utf-8"></script> --}}
@endsection
