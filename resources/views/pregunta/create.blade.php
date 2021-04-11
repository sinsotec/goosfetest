@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href=".." class="btn">< back</a>
            <div class="card">
                <div class="card-header">{{ __('Crear nuevo pregunta') }}</div>

                <div class="card-body">
                   <form action="/cuestionarios/{{ $cuestionario->id }}/preguntas" method="POST">
                    
                        @csrf

                        <div class="form-group">
                            <label for="pregunta">Pregunta</label>
                            {{-- <input name="pregunta[pregunta]" type="text" class="form-control" id="pregunta"
                                    aria-describedby="ayudaPregunta" placeholder="Ingresa la pregunta"> --}}
                            <textarea name="pregunta[pregunta]" id="pregunta" class="form-control"
                                aria-describedby="ayudaPregunta" placeholder="Ingresa la pregunta"></textarea>
                            <small id="ayudaPregunta" class="form-text text-muted">Escribe la pregunta</small>

                            @error('pregunta.pregunta')
                            <small class="text-danger">{{ __($message) }}</small>
                                
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Crear Pregunta</button>
                
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
