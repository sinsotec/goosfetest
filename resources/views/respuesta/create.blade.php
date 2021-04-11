@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="/cuestionarios/{{ $pregunta->cuestionario_id }}" class="btn">< back</a>
            <div class="card">
                <div class="card-header">{{ __('Crear nueva respuesta') }}</div>

                <div class="card-body">
                   <form action="/cuestionarios/preguntas/{{ $pregunta->id }}/respuestas" method="POST">
                    
                        @csrf
                        <p class="card-text">{{ $pregunta->pregunta }}</label>
                        <div class="form-group">
                            <div>
                                <label for="pregunta">Respuesta</label>
                            <input name="respuesta[respuesta]" type="text" class="form-control" id="respuesta"
                                    aria-describedby="ayudaRespuesta" placeholder="Ingresa la respuesta" value="{{old('respuesta.respuesta')}}">
                            <small id="ayudaRespuesta" class="form-text text-muted">Escribe la respuesta</small>

                            @error('respuesta.respuesta')
                            <small class="text-danger">{{ __($message) }}</small>
                                
                            @enderror
                            </div>
                            <div>
                                <label for="puntaje">Puntaje</label>
                            <input name="respuesta[puntaje]" type="number" class="form-control" id="puntaje"
                                    aria-describedby="ayudaPuntaje" placeholder="Ingresa el puntaje" value="{{old('respuesta.puntaje')}}">
                            <small id="ayudaPuntaje" class="form-text text-muted">Escribe el puntaje</small>

                            @error('respuesta.puntaje')
                            <small class="text-danger">{{ __($message) }}</small>
                                
                            @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Agregar Respuesta</button>
                
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
