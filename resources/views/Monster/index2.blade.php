@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('mensaje'))
<div class="alert alert-dismissible" role="alert">
    {{Session::get('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<a href="{{url('Monster/create')}}" class="btn btn-success">Registrar nuevo Monstruo</a>
<br/>
<br/>
<table class="table table-light">

    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Logo</th> <!-- Cambié "Foto" a "Logo" -->
            <th>name</th>
            <th>description</th>
            <th>category</th>
            <th>ubication</th>
            <th>wk_elemental</th>
            <th>wk_estate</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach( $monsters as $Monster)
        <tr>
            <td>{{ $Monster->id }}</td>

            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$Monster->img_logo }}" width="100" alt="">
            </td> <!-- Cambié la imagen del monstruo por la del logo -->

            <td>{{ $Monster->name }}</td>
            <td>{{ $Monster->description }}</td>
            <td>{{ $Monster->category }}</td>
            <td>{{ $Monster->ubication }}</td>
            <td>{{ $Monster->wk_elemental }}</td>
            <td>{{ $Monster->wk_estate }}</td>

            <td>
                <a href="{{ url('/Monster/'.$Monster->id.'/edit') }}" class="btn btn-warning">
                    Editar
                </a>
                |
                <form action="{{url('/Monster/'.$Monster->id) }}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                </form>        
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!!$monsters->links()!!}
</div>
@endsection