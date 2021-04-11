{{-- @extends('layouts.app') --}}
@extends('adminlte::page')

@section('title', 'Cuestionarios')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">           
            <a href="/cuestionarios" class="btn">< back</a>
            <h1>Cuestionario</h1>  

            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="/cuestionarios/{{ $cuestionario->id }}">Preguntas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="/cuestionarios/{{ $cuestionario->id }}/conclusiones">Conclusiones</a>
                </li>
              </ul>


            <div class="card">
                <div class="row card-header">
                <h4 class="col">{{ __($cuestionario->titulo) }}</h4>
                <h5 class="col-auto align-self-center">Prioridad: {{ __($cuestionario->prioridad) }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ __($cuestionario->descripcion) }}</p>
                    <form action="/cuestionarios/{{ $cuestionario->id }}" method="POST">
                        @method('delete')    
                        @csrf
                        <a class="btn btn-primary" href="/cuestionarios/{{ $cuestionario->id }}/conclusiones/create">Agregar Conclusión</a>
                        <a class="btn btn-info" href="/cuestionarios/{{ $cuestionario->id }}/edit"><i class="fas fa-pencil-alt"></i></a>
                        <button class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                   </form>
                </div>
            </div> 

            <div class="row">
                <h2 class="col">Conclusiones</h2>
                <h3 class="col">Cantidad: {{ count($cuestionario->conclusiones) }}</h3>
            </div>
            @forelse($cuestionario->conclusiones->sortBy('puntuacion_min') as $conclusion)
                <div class="card">
                    <h3 class="card-header">{{ __('Conclusión') }} {{ $loop->index + 1 }}</h3>
                    <div class="card-body">
                        <p class="card-text">{{ __($conclusion->conclusion) }}</p>
                        <p class="card-text">Puntuación minima: {{ ($conclusion->puntuacion_min) }} </p>
                        <form class="row justify-content-end" action="/cuestionarios/{{ $cuestionario-> id }}/conclusiones/{{ $conclusion->id }}" method="POST">
                            @method('delete')    
                            @csrf
                            <a class="btn btn-info m-1" href="/cuestionarios/{{ $cuestionario-> id }}/conclusiones/{{ $conclusion->id }}/edit"><i class="fas fa-pencil-alt"></i></a>
                            <button class="btn btn-danger m-1" ><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
                
            @empty
                <div class="card">
                    <p class="card-header">No hay conclusiones</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
