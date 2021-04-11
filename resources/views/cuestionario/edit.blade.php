@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="/cuestionarios/{{ $cuestionario->id }}" class="btn">< back</a>
            <div class="card">
                <div class="card-header">{{ __('Editar cuestionario') }}</div>

                <div class="card-body">
                   <form action="/cuestionarios/{{ $cuestionario->id }}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input name="titulo" type="text" class="form-control" id="titulo" aria-describedby="ayudaTitulo" value="{{ $cuestionario->titulo }}">
                            <small id="ayudaTitulo" class="form-text text-muted">Modifica el titulo del cuestionario</small>

                            @error('titulo')
                            <small class="text-danger">{{ __($message) }}</small>
                                
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input name="descripcion" type="text" class="form-control" id="descripcion" aria-describedby="ayudaDescripcion" value="{{ $cuestionario->descripcion }}">
                            <small id="ayudaDescripcion" class="form-text text-muted">Modifica la descripcion</small>

                            @error('descripcion')
                            <small class="text-danger">{{ __($message) }}</small>
                                
                            @enderror
                        </div>
                        <input name="activo" type="text" hidden class="form-control" id="activo"  value="{{ $cuestionario->activo }}">                            
                        
                        <button type="submit" class="btn btn-primary">Guardar Cuestionario</button>
                
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
