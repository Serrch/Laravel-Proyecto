@extends('layouts.app')

@section('content')
<div class="container">
  <div class="justify-content-center">
    <a href="{{url('Monster/create')}}" class="btn btn-success">Registrar nuevo Monstruo</a>
  </div>  
<br/>
<br/>

<div class="row">
    @foreach ($monsters as $monster)
    <div class="col-md-4">
        <div class="card mb-3 card-img">
             <a href="{{ url('/Monster/'.$monster->id) }}" class="stretched-link "></a>
            <img class="card-img-top card-img" src="{{ asset('storage').'/'.$monster->img_logo }}" alt="{{ $monster->name }}" href="{{ url('/Monster/'.$monster->id) }}">
            <div class="card-body">
                <h5 class="card-title">{{ $monster->name }}</h5>
                <p class="card-text">{{ $monster->description }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Categoría: {{ $monster->category }}</li>
                    <li class="list-group-item">Ubicación: {{ $monster->ubication }}</li>
                    <li class="list-group-item">Debilidades Elementales: {{ $monster->wk_elemental }}</li>
                    <li class="list-group-item">Estados Alterados: {{ $monster->wk_estate }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
@endsection
