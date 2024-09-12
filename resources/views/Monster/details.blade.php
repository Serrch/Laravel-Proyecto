@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 bg-light rounded p-4">
            <div class="d-flex align-items-center">
                <!-- Imagen -->
                <div class="me-3" style="flex: 1;">
                    <img src="{{ asset('storage/'.$monster->img_monster) }}" alt="{{ $monster->name }}" class="img-fluid">
                </div>
                <!-- Texto -->
                <div class=" ms-3" style="flex: 2;">
                    <h3>{{ $monster->name }}</h3>
                    <p><strong>Ubicación:</strong> {{ $monster->ubication }}</p>
                    <p><strong>Descripción:</strong> {{ $monster->description }}</p>
                    
                    {{-- Extraer debilidades en un arreglo --}}
                    @php
                        $elementalWeaknesses = explode(',', $monster->wk_elemental); // Si las debilidades están separadas por comas
                        $statusWeaknesses = explode(',', $monster->wk_estate); // Similar para estados
                    @endphp

                    {{-- Mostrar debilidades --}}
                    <p><strong>Elemento Débil:</strong></p>
                    <div class="row mb-4">
                        @foreach ($elementalWeaknesses as $weakness)
                            @php
                                $weakness = trim($weakness);
                            @endphp
                            @switch($weakness)
                                @case('Fuego')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Fuego.png') }}" alt="Fuego">
                                    </div>
                                    @break
                                @case('Agua')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Agua.png') }}" alt="Agua">
                                    </div>
                                    @break
                                @case('Rayo')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Rayo.png') }}" alt="Rayo">
                                    </div>
                                    @break
                                @case('Hielo')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Hielo.png') }}" alt="Hielo">
                                    </div>
                                    @break
                                @case('Draco')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Draco.png') }}" alt="Draco">
                                    </div>
                                    @break
                                @default
                                    <div class="col d-flex justify-content-center">
                                        <span>Elemento desconocido</span>
                                    </div>
                            @endswitch
                        @endforeach
                    </div>

                    <p><strong>Estado Débil:</strong></p>
                    <div class="row mb-4">
                        @foreach ($statusWeaknesses as $weakness)
                            @php
                                $weakness = trim($weakness);
                            @endphp
                            @switch($weakness)
                                @case('Nitro')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Nitro.png') }}" alt="Nitro">
                                    </div>
                                    @break
                                @case('Veneno')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Veneno.png') }}" alt="Veneno">
                                    </div>
                                    @break
                                @case('Paralisis')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Paralisis.png') }}" alt="Paralisis">
                                    </div>
                                    @break
                                @case('Sueno')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Sueno.png') }}" alt="Sueno">
                                    </div>
                                    @break
                                @case('Aturdimiento')
                                    <div class="col d-flex justify-content-center">
                                        <img class="img-fluid border border-2" src="{{ asset('img/Aturdimiento.png') }}" alt="Aturdimiento">
                                    </div>
                                    @break
                                @default
                                    <div class="col d-flex justify-content-center">
                                        <span>Ninguna</span>
                                    </div>
                            @endswitch
                        @endforeach
                    </div>
                    <div class="ms-5">
                    <a href="{{ url('/Monster/'.$monster->id.'/edit') }}" class="btn btn-warning">Editar</a>
                    <form action="{{ url('/Monster/'.$monster->id) }}" method="post" class="d-inline">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres borrar?')">Borrar</button>
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
