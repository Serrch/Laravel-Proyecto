@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/Monster') }}" method="post" enctype="multipart/form-data" >
@csrf   
@include('Monster.form', ['modo'=>'Crear']);





</form>
</div>
@endsection