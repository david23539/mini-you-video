@extends('layouts.app')

@section("content")
<div class="container">
    <div class="row">
        <h2>Crear un nuevo video</h2>
        <hr>
        <form action="{{url('/guardar-video/')}}" method="POST" enctype="multipart/form-data" class="col-lg-7">
            {!! csrf_field() !!}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                
            @endif
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
            </div>

            <div class="form-group">
                <label for="description">Descripcion</label>
                <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Miniatura</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>

            <div class="form-group">
                <label for="video">Video</label>
                <input type="file" name="video" class="form-control" id="video">
            </div>

            <button type="submit" class="btn btn-success">Crear Video</button>
        </form>
    </div>

</div>

@endsection