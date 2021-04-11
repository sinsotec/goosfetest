@extends('adminlte::page')

@section('content')')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="/cuestionarios/{{ $pregunta->cuestionario_id }}" class="btn">< back</a>
            <div class="card">
                <div class="card-header">{{ __('Editar pregunta') }}</div>

                <div class="card-body">
                   <form action="/cuestionarios/preguntas/{{ $pregunta->id}}" method="POST">
                        @method('patch')
                        @csrf

                        <div class="form-group">
                            <label for="pregunta">Pregunta</label>
                            <input name="pregunta" type="text" class="form-control" id="pregunta" aria-describedby="ayudaPregunta" value="{{ $pregunta->pregunta }}">
                            <small id="ayudaPregunta" class="form-text text-muted">Modifica la pregunta</small>

                            @error('pregunta')
                            <small class="text-danger">{{ __($message) }}</small>
                                
                            @enderror
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary">Guardar Pregunta</button>
                
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
