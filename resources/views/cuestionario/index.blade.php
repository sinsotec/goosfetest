{{-- @extends('layouts.app') --}}
@extends('adminlte::page')

@section('title', 'Cuestionarios')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row card-header"><h1 class="col">Cuestionarios</h1> <a class="col-auto align-self-center" href="/cuestionarios/create">Agregar Cuestionario</a></div>
                        <ul class="list-group list-group-flush">
                        @forelse ($cuestionarios as $cuestionario)
                            <li class="list-group-item">{{ $cuestionario->titulo }}                    
                                {{-- <form action="">
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ $cuestionario->path() }}">Modificar Cuestionario</a>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" {{ $cuestionario->activo ? 'checked' : '' }} >
                                            <label class="custom-control-label" for="customCheck1">{{ $cuestionario->activo ? 'Activo' : 'Inactivo' }}</label>
                                        </div>
                                    </div>
                                </form> --}}
                                <form action="/cuestionarios/{{ $cuestionario->id }}"  method="POST">
                                    @method('patch')
                                    @csrf
                                    <div class="float-right">
                                        <a class="btn btn-info" href="{{ $cuestionario->path() }}"><i class="fas fa-pencil-alt"></i></a>
                                        <input name="titulo" type="text" hidden class="form-control" id="titulo" value="{{ $cuestionario->titulo }}">
                                        <input name="descripcion" type="text" hidden class="form-control" id="descripcion"  value="{{ $cuestionario->descripcion }}">                            
                                        <input type="text" name="activo" id="activo" hidden value="{{ $cuestionario->activo ? '0' : '1' }}">
                                    <button class="btn {{ $cuestionario->activo ? 'btn-success' : 'btn-danger' }}" >{{ $cuestionario->activo ? 'Desactivar' : 'Activar' }}</button>
                                    </div>
                                </form>
                            </li>   
                        @empty
                        <li class="list-group-item">No hay cuestionarios</li>        
                        @endforelse
                        </ul>
            </div>           
        </div>
    </div>
</div>
@endsection
