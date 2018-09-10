@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <h2>Has buscado: {{$search}}</h2>
            <div class="col-md-10">
                <form class="col-md-4 pull-rigth" action="{{url('/buscar/'.$search)}}" method="GET">
                    <label for="filter">Ordenar</label>
                    <select name="filter" class="form-control">
                        <option value="new">Mas nuevo primero</option>
                        <option value="old">Mas antiguos primero</option>
                        <option value="alfa">de la A a la Z</option>
                    </select>
                    <input type="submit" class="btn btn-primary" value="ordenar">
                </form>
            </div>
            @include('video.videosList')
            
        </div>
    </div>
</div>
@endsection