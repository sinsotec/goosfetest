@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="/cuestionarios/{{ $cuestionario->id }}/conclusiones" class="btn">< back</a>
            <div class="card">
                <div class="card-header">{{ __('Editar conclusión') }}</div>

                <div class="card-body">
                   <form action="/cuestionarios/{{ $cuestionario->id }}/conclusiones/{{ $conclusion->id }}" method="POST">
                        @method('patch')
                        @csrf
                        <div>
                            <div class="form-group">
                                <label for="conclusion">Conclusión</label>
                                <textarea name="conclusion[conclusion]" id="conclusion" class="form-control"
                                    aria-describedby="ayudaConclusion" placeholder="Agrega una conclusión">{{ old('conclusion.conclusion') ?? $conclusion->conclusion }}</textarea>
                                <small id="ayudaConclusion" class="form-text text-muted">Escribe la conclusión</small>

                                @error('conclusion.conclusion')
                                <small class="text-danger">{{ __($message) }}</small>
                                    
                                @enderror
                            </div>
                        
                            <div class="row">
                        
                                <div class="col-3">
                                    <label for="puntuacion_min">Puntación Minina</label>
                                    <input name="conclusion[puntuacion_min]" type="number" min="1" class="form-control" id="puntuacion_min"
                                            aria-describedby="ayudaPuntuacionMin" {{-- placeholder="Puntaje minimo" --}} value="{{ old('conclusion.puntuacion_min') ?? $conclusion->puntuacion_min }}">
                                    <small id="ayudaPuntuacionMin" class="form-text text-muted">Ingresa un valor</small>

                                    @error('conclusion.puntuacion_min')
                                    <small class="text-danger">{{ __($message) }}</small>
                                        
                                    @enderror
                                </div>

                            </div>    

                        </div>                   
                        <button type="submit" class="btn btn-primary mt-2">Guardar Conclusión</button>
                
                    </form>

                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
